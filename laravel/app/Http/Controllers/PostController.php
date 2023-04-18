<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        // phpinfo();
        // exit;
        
        // view create form
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r(request()->title); echo"<br>";
        // print_r(request()->body); echo"<br>";
        // print_r(request()->image); echo"<br>";
        // exit;

        // validate incoming request data with validation rules
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        // store data with create() method
        $post = Post::create([
            'user_id'   => auth()->id(),
            'title'     => request()->title,
            'body'      => request()->body,
        ]);
        
        
        if ($request->hasFile('image')) {
            $post->image = $request->file('image');
            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
            $post->save();
        }

        // redirect to show post URL
        // return redirect($post->path());
        return redirect($post->path())->with([
            'success' => 'You have successfully uploaded image.',
            'image' => $imageName
        ]);

        $postId = $request->input('postId');
        $likeType = $request->input('likeType');

        $like = new Like;
        $like->post_id = $postId;
        $like->type = $likeType;
        $like->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // we are using route model binding 
        // view show page with post data
        // echo "<pre>"; print_r ($post); echo "</pre>";
        // exit;
        return view('posts.show')->with('post', $post);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // we are using route model binding 
        // view edit page with post data
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validate incoming request data with validation rules
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        // update post with new data using update() method
        $post->update([
            'title'     => request()->title,
            'body'      => request()->body
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image');
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $post->image = 'uploads/' . $imageName;
            $post->save();
        }

        // return to show post URL
        return redirect($post->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function fetchLike(Request $request)
    {
        $post = Post::find($request->post);
        return response()->json([
            'post' => $post,
        ]);
    }
 
    public function handleLike(Request $request)
    {
        $post = Post::find($request->post);
        $value = $post->like;
        $post->like = $value+1;
        $post->save();
        return response()->json([
            'message' => 'Liked',
        ]);
    }    
 
    public function fetchDislike(Request $request)
    {
        $post = Post::find($request->post);
        return response()->json([
            'post' => $post,
        ]);
    }
 
    public function handleDislike(Request $request)
    {
        $post = Post::find($request->post);
        $value = $post->dislike;
        $post->dislike = $value+1;
        $post->save();
        return response()->json([
            'message' => 'Disliked',
        ]);
    }

    public function likeDislikePost(Request $request)
    {
        $post = Post::find($request->id);
        if (!$post) {
            return response()->json(['status' => false, 'message' => 'Post not found']);
        }

        if ($request->type == 'like') {
            $post->likes++;
        } elseif ($request->type == 'dislike') {
            $post->dislikes++;
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid type']);
        }

        $post->save();
        return response()->json(['status' => true, 'message' => 'Post updated successfully']);
    }
    public function like(Request $request)
    {
        $user = $request->user();
        $post_id = $request->input('post_id');
        $type = $request->input('type');

        // 해당 포스트에 대해 사용자가 이미 좋아요/싫어요를 했는지 확인
        $like = Like::where('user_id', $user->id)
            ->where('post_id', $post_id)
            ->first();

        // 좋아요/싫어요를 처음 누른 경우
        if (!$like) {
            $like = new Like;
            $like->user_id = $user->id;
            $like->post_id = $post_id;
            $like->type = $type;
            $like->save();

            if ($type == 'like') {
                $message = 'Liked!';
            } else {
                $message = 'Disliked!';
            }
        }
        // 이미 좋아요/싫어요를 누른 경우
        else{
            // 이미 누른 버튼을 다시 누른 경우
            if ($like->type == $type) {
                $like->delete();

                if ($type == 'like') {
                    $message = 'Unliked!';
                } else {
                    $message = 'Undisliked!';
                }
            }
        }
    }
}