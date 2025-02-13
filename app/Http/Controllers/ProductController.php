<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // productos activos con las categorias
        $products = Product::where('state', true)->with('categories')->get();
        return view('product.index', compact(['products']));
    }

    public function create()
    {
        $categories = Category::where('state', true)->get();

        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // validaciones 
        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'categories' => 'required',
            'state' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->state = $request->state == 'on';

        $image = $request->file('image');
        
        if ($image) {
            $imagenBase64 = base64_encode(file_get_contents($image));
            $product->image = $imagenBase64;
        }

        $product->save();

        // agregar categorias
        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }

        return redirect()->route('product.index')->with('success', 'Producto creado exitosamente');
    }

    public function edit($id)
    {
        // producto con categoria
        $product = Product::with('categories')->find($id);

        if (!$product) {
            return redirect()->route('product.index')->withErrors(['name' => 'Producto no encontrado']);
        }
        $categories = Category::all();

        return view('product.edit', compact(['product', 'categories']));
    }

    public function update(Request $request, $id)
    {
        // validaciones
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $id,
            'description' => 'required',
            'categories' => 'required',
            'state' => 'required',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->withErrors(['name' => 'Producto no encontrado']);
        }

        // validar que no se repita el nombre
        if (Product::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->route('product.edit', $id)->withErrors(['name' => 'Producto ya existe']);
        }

        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->state = $request->state == 'on';

        $image = $request->file('image');
        if ($image) {
            $imagenBase64 = base64_encode(file_get_contents($image));
            $product->image = $imagenBase64;
        }

        $product->save();

        // agregar nuevas categorias
        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }

        ///  categorias del producto
        $categoriesProduct = CategoryProduct::where('product_id', $id)->get();

        foreach ($categoriesProduct as $categoryProduct) {
            if (!$request->categories->contains($categoryProduct->category_id)) {
                $categoryProduct->state = false;
                $categoryProduct->save();
            }
        }


        return redirect()->route('product.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->withErrors(['name' => 'Producto no encontrado']);
        }
        $product->state = false;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto eliminado exitosamente');
    }
}
