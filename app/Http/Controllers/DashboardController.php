<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 public  function index(){
        $posts = Auth::user()->posts()->latest()->paginate(2);
        // $post = Post::where('user_id', Auth::id())->get();
        // dd($posts);
        return view('users.dashboard',['posts'=>$posts]);
 }
 public function userPosts(User $user){
        // dd($user->posts);
        $userPosts=$user->posts()->latest()->paginate(2);
        return view('users.posts',['posts'=>$userPosts,
                'user'=>$user

    ]);
 }
}
