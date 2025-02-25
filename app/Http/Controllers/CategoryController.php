<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('state', 1)->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        // validaciones 
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name',
                // 'description' => 'required',
                'state' => 'required',
            ]
            // mensajes de error en español
            ,
            [
                'name.unique' => 'El nombre de la categoria ya existe',
                'state.required' => 'El estado es obligatorio',
            ]
        );

        $image = $request->file('image');

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->state = $request->state == 'on';

        if ($image) {
            $imagenBase64 = base64_encode(file_get_contents($image));
            $category->image = $imagenBase64;
        }
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoria creada exitosamente');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->withErrors(['name' => 'Categoria no encontrada']);
        }
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // validaciones
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name,' . $id,
                // 'description' => 'required',
                'state' => 'required',
            ]
            // mensajes de error en español
            ,
            [
                'name.unique' => 'El nombre de la categoria ya existe',
                'state.required' => 'El estado es obligatorio',
            ]
        );

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->withErrors(['name' => 'Categoria no encontrada']);
        }
        
        $category->name = $request->name;
        $category->description = $request->description;
        $category->state = $request->state == 'on';

        $image = $request->file('image');

        if ($image) {
            $imagenBase64 = base64_encode(file_get_contents($image));
            $category->image = $imagenBase64;
        }

        $category->save();

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->withErrors(['name' => 'Categoria no encontrada']);
        }

        // $category->delete();
        // Eliminado logico
        $category->state = false;
        $category->save();


        return redirect()->route('category.index')->with('success', 'Categoria eliminada exitosamente');
    }
}
