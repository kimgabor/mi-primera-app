<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::latest()->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:100',
            'body' => 'required|string|min:10',
        ]);

        Posts::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post publicado correctamente.');
    }

    public function edit($id): View
    {
        $post = Posts::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id): RedirectResponse
{
    $post = Posts::findOrFail($id);
    $validated = $request->validate([ // Primero, antes de actualizar, hacemos una validación
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'body'  => ['required', 'string']
    ]);
    $post->update($validated);
    return redirect()->route('posts.index')->with('success', 'El post se actualizó correctamente.');
}

public function destroy($id): RedirectResponse
{
    $post = Posts::findOrFail($id);
    $post->delete();
    return redirect()->route('posts.index')->with('success', 'El post se eliminó correctamente.');
}
}