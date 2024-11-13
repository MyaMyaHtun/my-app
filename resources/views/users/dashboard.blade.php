

<x-layout>
   <h1>Welcome {{auth()->user()->username}}, you have{{$posts->total()}} posts</h1>
   {{-- Create Post Form --}}
   <div class="card mb-8">
    <h2 class="font-bold mb-4">Create a new post</h2>

    {{-- Session Message --}}
    @if(session('success'))
        <x-flashMsg msg="{{session('success')}}"/>
    @elseif (session('delete'))
        <x-flashMsg msg="{{session('delete')}}" bg="bg-red-500"/>
    @endif

    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Post title --}}
    <div class="mb-4">
        <label for="title">Post Title</label>
        <input  type="text" class="input" name="title" value="{{ old('title')}}" >
        @error('title')
        <p style="color:red;">{{$message}}</p>
        @enderror
    </div>
    {{-- Post Body --}}
    <div class="mb-4">
        <label for="body">Post Content</label>
        <textarea style="width: 600px;" class="input" name="body" id="" rows="5"  value="{{ old('body')}}"></textarea>
        {{-- <input type="text" class="input" name="body"  > --}}
        @error('body')
        <p style="color:red;">{{$message}}</p>
        @enderror
    </div>
    {{-- Post Image --}}
    <div class="mb-4">
        <label for="image">Cover photo</label>
        <input type="file" name="image" id="image">
        @error('image')
        <p style="color:red;">{{$message}}</p>
        @enderror
    </div>

    {{-- Submit button --}}
    <button type="submit" class="submit-btn">Create</button>
    </form>
   </div>
   {{-- User Posts --}}
   <h2 class="font-bold mb-4">Your Latest Posts</h2>
   <div class="grid grid-cols-2 ga">
    @foreach ($posts as $post )
    <x-postCard :post="$post">
        {{-- Update Post --}}
        <a href="{{route('posts.edit',$post)}}" class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>
{{-- Delete Post --}}
{{-- <p>delete</p> --}}
<form action="{{route('posts.destroy',$post)}}" method="post">
    @csrf
    @method('DELETE')
    <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
</form>
    </x-postCard>

    @endforeach
</div>

<div>
{{$posts->links()}}
</div>
</x-layout>
