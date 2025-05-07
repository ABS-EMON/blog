@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        padding: 20px;
    }

    .edit-container {
        max-width: 700px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    h1.page-title {
        text-align: center;
        color: #2c3e50;
        font-size: 28px;
        margin-bottom: 25px;
    }

    form label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
        color: #555;
    }

    form input,
    form textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    form .error-text {
        color: #e74c3c;
        font-size: 13px;
        margin-top: -15px;
        margin-bottom: 15px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-submit {
        background-color: #3498db;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #2980b9;
    }

    .btn-cancel {
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .btn-cancel:hover {
        color: #e74c3c;
        text-decoration: underline;
    }
</style>

<div class="edit-container">
    <h1 class="page-title">Edit Post: {{ $post->title }}</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="body">Body:</label>
            <textarea id="body" name="body" rows="10" required>{{ old('body', $post->body) }}</textarea>
            @error('body')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Post</button>
            <a href="{{ route('posts.show', $post) }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
