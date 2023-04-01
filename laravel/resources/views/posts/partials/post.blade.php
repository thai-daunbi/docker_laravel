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

    <!-- <img src="{{ asset($post->image) }}" class="w-60 h-60"alt="{{ asset($post->image) }}"> -->
    <!-- <img src="images/{{ Session::get('image') }}" class="mb-2" style="width:400px;height:200px;"> -->
    <!-- <img src="{{ asset('images/' . Session::get('image')) }}" class="mb-2" style="width:400px;height:200px;"> -->
    <img src="{{ asset('images/' . Session::get('image')) }}" class="mb-2" style="width:400px;height:200px;">





    {{-- include all comments related to this post --}}
    <hr>
    @include('posts.partials.comments')
  </div>
</div>