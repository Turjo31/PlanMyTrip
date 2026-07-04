<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show all posts (public)
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('community.index', compact('posts'));
    }

    // Show create post form
    public function create()
    {
        return view('community.create');
    }

    // Store new post
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'destination' => 'nullable|string|max:255',
        ]);

        Post::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'body'        => $request->body,
            'destination' => $request->destination,
        ]);

        return redirect()->route('community.index')->with('success', 'Story posted successfully!');
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'destination' => 'nullable|string|max:255',
        ]);

        $post->update($request->all());

        return redirect()->route('community.index')->with('success', 'Story updated successfully!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('community.index')->with('success', 'Story deleted successfully!');
    }
}