<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()
            ->categories()
            ->withCount('purchases')
            ->orderBy('name')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:80',
                Rule::unique('categories')->where('user_id', $request->user()->id),
            ],
        ]);

        $request->user()->categories()->create($data);

        return redirect()->route('categories.index')->with('status', 'Categoria creada.');
    }

    public function edit(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        abort_unless($category->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:80',
                Rule::unique('categories')->where('user_id', $request->user()->id)->ignore($category),
            ],
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('status', 'Categoria actualizada.');
    }

    public function destroy(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        if ($category->purchases()->exists()) {
            return back()->withErrors('No puedes eliminar una categoria con compras registradas.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Categoria eliminada.');
    }
}
