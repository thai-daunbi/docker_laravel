<div class="card shadow">
  <div class="card-body">

  	{{-- Post title  --}}
    <h4 class="card-title">
    	{{ $post->title }}
    </h4>

    {{-- Owner name with created_at --}}
    <small class="text-muted">
    	Posted by: <b>{{ $post->owner->name }}</b> on {{ $post->created_at->format('M d, Y H:i:s') }}
    </small>

    {{-- Post body --}}
    <p class="card-text">
    	{{ $post->body }}
    </p>

    <img src="{{ asset('images/' . $post->image) }}" class="mb-2" style="width:400px;height:200px;">


    <div class="col-md-6">
        <button class="like-btn btn btn-primary" data-id="{{ $post->id }}" onclick="likeDislikePost(event, 'like')">
            <i class="far fa-thumbs-up"></i>
            <span class="likes">{{ $post->likes }}</span>
        </button>
        <button class="like-btn btn btn-danger" data-id="{{ $post->id }}" onclick="likeDislikePost(event, 'dislike')">
            <i class="far fa-thumbs-down"></i>
            <span class="dislikes">{{ $post->dislikes }}</span>
        </button>
    </div>
    {{-- include all comments related to this post --}}
    <hr>
    @include('posts.partials.comments')
  </div>
</div>