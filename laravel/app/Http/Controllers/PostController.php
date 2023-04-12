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
<<<<<<< HEAD
<<<<<<< HEAD
        ]);        
=======
        ]);

        $like = new Like([
            'user_id' => auth()->id(),
            'likeable_type' => 'App\Models\Post', // set the likeable_type attribute
        ]);
        $post->likes()->save($like);
>>>>>>> parent of 22577d2 (error(does not exist))

        return redirect()->route('post.show', $post);
    }
    // public function like(Post $post)
    // {
    //     $like = $post->likes()->where('user_id', auth()->id())->first();

    //     if ($like) {
    //         $like->delete();
    //     } else {
    //         $like = new Like([
    //             'user_id' => auth()->id(),
    //         ]);
    //         $post->likes()->save($like);
    //     }

<<<<<<< HEAD
=======
        ]);
    }

>>>>>>> parent of 3e2d5c1 (Errors for new code)
=======
    //     return back();
    // }
>>>>>>> parent of 22577d2 (error(does not exist))
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
}
