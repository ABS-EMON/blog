@extends('layouts.app')

@section('title', 'Edit Comment')

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
        padding: 10px;
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
        padding: 10px 20px;
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
    <h1 class="page-title">Edit Comment</h1>

    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name (Optional):</label>
            <input type="text" id="name" name="name" value="{{ old('name', $comment->name) }}">
        </div>

        <div>
            <label for="body">Comment Body:</label>
            <textarea id="body" name="body" rows="5" required>{{ old('body', $comment->body) }}</textarea>
            @error('body')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Comment</button>
            <a href="{{ route('posts.show', $comment->post) }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
