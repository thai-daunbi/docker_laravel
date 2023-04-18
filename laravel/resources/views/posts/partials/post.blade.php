<!-- <div class="card shadow">
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


     <like-component :post="{{ $post->id }}"></like-component>
    <dislike-component :post="{{ $post->id }}"></dislike-component>

    <div class="col-md-6">
        <button class="like-btn btn btn-primary" data-id="{{ $post->id }}" >
            <i class="far fa-thumbs-up"></i>
            <span class="likes">{{ $post->likes }}</span>
        </button>
        <button class="like-btn btn btn-primary" data-post-id="{{ $post->id }}" data-like-type="like" >
            <i class="far fa-thumbs-up"></i>
            <span class="likes">{{ $post->likes }}</span>
        </button>
        <button class="like-btn btn btn-danger" data-id="{{ $post->id }}" >
            <i class="far fa-thumbs-down"></i>
            <span class="dislikes">{{ $post->dislikes }}</span>
        </button>
    </div>
    {{-- include all comments related to this post --}}
    <hr>
    @include('posts.partials.comments')
  </div>
</div> -->

<!-- $('.btn-like').click(function() {
    var postId = $(this).data('post-id');
    var likeType = $(this).data('like-type');
    $.ajax({
        type: 'POST',
        url: '{{ route('like.store') }}',
        data: {
            postId: postId,
            likeType: likeType,
        },
        success: function(response) {
            // 저장 성공시 처리할 내용
        }
    });
}); -->

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
            <button class="like-btn btn btn-primary" data-post-id="{{ $post->id }}" data-like-type="like" >
                <i class="far fa-thumbs-up"></i>
                <span class="likes">{{ $post->likes }}</span>
            </button>
            <button class="like-btn btn btn-danger" data-id="{{ $post->id }}" >
                <i class="far fa-thumbs-down"></i>
                <span class="dislikes">{{ $post->dislikes }}</span>
            </button>
        </div>

        <hr>
        @include('posts.partials.comments')
      </div>
    </div>

    <script>
      // csrf_token 가져오기
var csrfToken = $('meta[name="csrf-token"]').attr('content');

// ajax 요청에 토큰 포함하기
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});

// ajax 요청 보내기
$.ajax({
    type: 'POST',
    url: '{{ route('like.store') }}',
    data: {
        postId: postId,
        likeType: likeType,
    },
    success: function(response) {
        // 저장 성공시 처리할 내용
    }
});
3
        $('.like-btn').click(function() {
            var postId = $(this).data('post-id');
            var likeType = $(this).data('like-type');
            $.ajax({
                type: 'POST',
                url: '{{ route('like.store') }}',
                data: {
                    postId: postId,
                    likeType: likeType,
                },
                success: function(response) {
                    // 저장 성공시 처리할 내용
                }
            });
        });
    </script>
</body>
