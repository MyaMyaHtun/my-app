<x-layout>

 <a href="{{route('dashboard')}}" class="block mb-2 text-xs text-blue-500"> &larr; Go back to your dashboard</a>
<div class="card">
    <h2 class="font-bold mb-4">Update a new post</h2>
    <form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Post title --}}
        <div class="mb-4">
            <label for="title">Post Title</label>
            <input  type="text" class="input" name="title" value="{{ $post->title}}" >
            @error('title')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>
        {{-- Post Body --}}
        <div class="mb-4">
            <label for="body">Post Content</label>
            <textarea style="width: 600px;" class="input" name="body" id="" rows="5"  value="">{{ $post->body}}</textarea>
            {{-- <input type="text" class="input" name="body"  > --}}
            @error('body')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>
        {{-- Current cover photo if exits --}}

            @if ($post->image)
        <div class="h-64 rounded-md mb-4 w-164 object-cover overflow-hidden">
            <label for="">Current cover photo</label>
            <img src="{{asset('storage/' . $post->image)}}" alt="" >
        </div>
            @endif
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image">
                @error('image')
                <p style="color:red;">{{$message}}</p>
                @enderror
            </div>


        {{-- Submit button --}}
        <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</x-layout>
