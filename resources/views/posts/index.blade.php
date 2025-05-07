@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        color: #333;
        padding: 20px;
    }

    .blog-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    h1.page-title {
    text-align: center;
    margin-bottom: 30px;
    font-size: 36px;
    font-weight: bold;
    background: linear-gradient(to left,  rgb(255, 235, 59), rgb(76, 175, 80),rgb(244, 67, 54), rgb(33, 150, 243));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}


  

    .post-box {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: stretch; /* make children stretch full height */
    min-height: 180px;
}

.post-actions {
    display: flex;
    flex-direction: column;
    justify-content: flex-end; /* push buttons to the bottom */
    gap: 10px;
    align-items: flex-end;
}

    .post-content {
        max-width: 70%;
    }

    .post-content h2 {
        margin-bottom: 10px;
        font-size: 24px;
        color: #2c3e50;
    }

    .post-content p {
        color: #555;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .post-content small {
        display: block;
        margin-bottom: 15px;
        color: #888;
    }

 

    .btn-readmore,
    .btn-edit,
    .btn-delete {
        padding: 6px 14px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        text-align: center;
    }

    .btn-readmore {
        background-color: #3498db;
        align-self: flex-start;
    }

    .btn-edit {
        background-color: #f1c40f;
        color: #000;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-readmore:hover,
    .btn-edit:hover,
    .btn-delete:hover {
        opacity: 0.85;
    }

    .no-blogs {
        text-align: center;
        font-style: italic;
        color: #888;
        margin-top: 30px;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    form.inline {
        display: inline-block;
    }
</style>

<div class="blog-container">
    <h1 class="page-title">Welcome to the Blog Websites</h1>
    <marquee behavior="scroll" direction="left" style="color: #F671C1; font-size: 24px; font-weight: bold;">Hi 👋, I'm ABU BAKKAR SIDDIQUE EMON</marquee>
    <marquee behavior="scroll" direction="right" style="color: #6474F2; font-size: 24px; font-weight: bold;">Studying at IoT and Robotics Engineering at BDU</marquee>
    @if ($posts->isEmpty())
        <p class="no-blogs">No posts found.</p>
    @else
        @foreach ($posts as $post)
            <div class="post-box">
                <div class="post-content">
                    <h2>
                        <a href="{{ route('posts.show', $post) }}" style="text-decoration: none;">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p>{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>
                    <small>Posted on {{ $post->created_at->format('M d, Y') }}</small>
                    <a href="{{ route('posts.show', $post) }}" class="btn-readmore">Read More</a>
                </div>
                <div class="post-actions">
                    <a href="{{ route('posts.edit', $post) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    <div class="button-container">
        {{ $posts->links() }}
    </div>
</div>

@endsection
