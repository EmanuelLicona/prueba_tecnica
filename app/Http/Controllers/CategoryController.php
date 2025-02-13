<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        // validaciones 
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            // 'description' => 'required',
            'state' => 'required',
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->state = $request->state == 'on';
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
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id,
            // 'description' => 'required',
            'state' => 'required',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index')->withErrors(['name' => 'Categoria no encontrada']);
        }

        // validar que no se repita el nombre
        if (Category::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->route('category.edit', $id)->withErrors(['name' => 'Categoria ya existe']);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->state = $request->state == 'on';
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
