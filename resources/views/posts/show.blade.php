@extends('layouts.app')

@section('title', $post->title)

@section('content')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    h1.post-title {
        font-size: 32px;
        margin-bottom: 10px;
        color: #222;
    }

    p.post-date {
        color: #888;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .post-body {
        color: #444;
        line-height: 1.7;
        white-space: pre-wrap;
    }

    .button-group {
        margin-top: 20px;
        text-align: right;
    }

    .btn {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 6px;
        font-weight: bold;
        color: white;
        text-decoration: none;
        margin-left: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-edit {
        background-color: #f1c40f;
    }

    .btn-edit:hover {
        background-color: #d4ac0d;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .btn-comment {
        background-color: #2ecc71;
    }

    .btn-comment:hover {
        background-color: #27ae60;
    }

    .comment-form label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
    }

    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .comment {
        background-color: #f4f4f4;
        padding: 15px;
        border-left: 4px solid #3498db;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .comment small {
        color: #666;
        display: block;
        margin-top: 10px;
    }

    .comment-actions {
        margin-top: 10px;
        text-align: right;
    }

    .comment-actions a,
    .comment-actions form button {
        display: inline-block;
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 5px;
    }

    .comment-actions a {
        background-color: #f1c40f;
        color: white;
    }

    .comment-actions a:hover {
        background-color: #d4ac0d;
    }

    .comment-actions form button {
        background-color: #e74c3c;
        color: white;
        border: none;
    }

    .comment-actions form button:hover {
        background-color: #c0392b;
    }

    .back-link {
        text-align: center;
        margin-top: 40px;
    }

    .back-link a {
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
        border: 2px solid #3498db;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .back-link a:hover {
        background-color: #3498db;
        color: #fff;
    }
</style>

<div class="container">
    <h1 class="post-title">{{ $post->title }}</h1>
    <p class="post-date">Posted on {{ $post->created_at->format('F j, Y') }}</p>
    <div class="post-body">
        {!! nl2br(e($post->body)) !!}
    </div>

    <div class="button-group">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-edit">Edit Post</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">Delete Post</button>
        </form>
    </div>
</div>

<div class="container">
    <h2 class="post-title" style="font-size: 24px;">Comments ({{ $post->comments->count() }})</h2>

    {{-- Add Comment Form --}}
    <form action="{{ route('comments.store', $post) }}" method="POST" class="comment-form">
        @csrf
        <label for="name">Name (Optional):</label>
        <input type="text" id="name" name="name" value="{{ old('name', 'Anonymous') }}">

        <label for="comment_body">Your Comment:</label>
        <textarea id="comment_body" name="body" rows="4" required>{{ old('body') }}</textarea>
        @error('body', 'comment')
            <p style="color: red; font-size: 13px;">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-comment">Add Comment</button>
    </form>

    {{-- Display Comments --}}
    @forelse ($post->comments as $comment)
        <div class="comment">
            <p>{!! nl2br(e($comment->body)) !!}</p>
            <small><strong>{{ $comment->name }}</strong> commented {{ $comment->created_at->diffForHumans() }}</small>
            <div class="comment-actions">
                <a href="{{ route('comments.edit', $comment) }}">Edit</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this comment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p class="no-blogs">No comments yet. Be the first to comment!</p>
    @endforelse
</div>

<div class="back-link">
    <a href="{{ route('posts.index') }}">&larr; Back to all posts</a>
</div>

@endsection
