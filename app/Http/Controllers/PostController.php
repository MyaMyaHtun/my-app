<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Mail\WelcomeMail;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['index','show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Mail::to('elise@gmail.com')->send(new WelcomeMail());
        $posts = Post::latest()->paginate(2);

        // dd($posts);
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd('ok');

        // dd($request);
        // Validate
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:1000','mimes:webp,png,jpg']
        ]);
        // $path = null;
        //Store image if exits
        if($request->hasFile('image')){
           $path= Storage::disk('public')->put('posts_images', $request->image);
        }
        // dd($path);

        //Create Post
        Auth::user()->posts()->create(['title'=>$request->title,
        'body'=>$request->body,
        'image'=>$path,
        ]);
        // Post::create(['user_id'=> Auth::id(), ...$fields]);

        //Redirect to dashboard
        // dd("OK");
        return back()->with('success', 'Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify', $post);
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:1000','mimes:webp,png,jpg']
        ]);
        //Store image if exits
        $path = $post->image ?? null;
        if($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete(
                    $post->image
                );
            }
            $path= Storage::disk('public')->put('posts_images', $request->image);

         }

        //Update Post
        $post->update([ 'title'=>$request->title,
        'body'=>$request->body,
        'image'=>$path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your post was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);
        // dd("ok");

        //Delete posst image if exits
        if($post->image){
            Storage::disk('public')->delete(
                $post->image
            );
        }

        $post->delete();
        return back()->with('delete', 'Your post was deleted!');
    }
}
