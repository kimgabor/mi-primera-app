<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

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
}