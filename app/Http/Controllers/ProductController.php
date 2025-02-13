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
        // Validaciones
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $id,
            'description' => 'required',
            'categories' => 'required|array',  
            'state' => 'required',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->withErrors(['name' => 'Producto no encontrado']);
        }

        if (Product::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->route('product.edit', $id)->withErrors(['name' => 'Producto ya existe']);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->state = $request->state == 'on';

        $image = $request->file('image');
        if ($image) {
            $imagenBase64 = base64_encode(file_get_contents($image));
            $product->image = $imagenBase64;
        }

        $product->save();

        // Obtener las categorías actuales del producto
        $currentCategories = $product->categories->pluck('id')->toArray();

        // Obtener las categorías que vienen en la request
        $newCategories = $request->categories;

        // Eliminar las categorías que no están en la nueva lista
        $categoriesToDetach = array_diff($currentCategories, $newCategories);
        $product->categories()->detach($categoriesToDetach);

        // Agregar las categorías nuevas que no están ya asociadas
        $categoriesToAttach = array_diff($newCategories, $currentCategories);
        $product->categories()->attach($categoriesToAttach);

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

    public function productByCategory(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        $products = $category->products;

        return view('product.category', compact(['products', 'category']));
    }
}
