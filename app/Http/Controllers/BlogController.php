<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    //To show all blog posts
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }
    //to create a new blog post
    public function create()
    {
        return view('blogs.create');
    }
    //to store a new blog post
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new blog post
        Blog::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully!');    
    }  
}
