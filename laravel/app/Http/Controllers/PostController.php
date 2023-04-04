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
        
        // if ($request->hasFile('image')) {
        //     $post->image = $request->file('image');
        //     $imageName = $request->file('image')->getClientOriginalName();
        //     $request->image->move(public_path('images'), $imageName);
        //     $post->save();
        // }
        if ($request->hasFile('image')) {
            $post->image = $request->file('image');
            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
            $post->save();
        }

        // $image_name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        // $image_path = 'uploads/' . $image_name;
        // Image::make($request->file('image')->getRealPath())->resize(320, 240)->save(public_path($image_path));
        // $post->image = $image_path;
        // $post->save();

        // $image_name = uniqid() . '.' . $this['image']->getClientOriginalExtension();
        // $image_path = 'uploads/' . $image_name;
        // Image::make($this['image'])->resize(320, 240)->save(public_path($image_path));
        // $this['image'] = $image_path;
        // $post = Post::create($this);

        // redirect to show post URL
        // return redirect($post->path());
        return redirect($post->path())->with([
            'success' => 'You have successfully uploaded image.',
            'image' => $imageName
        ]);
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
}
