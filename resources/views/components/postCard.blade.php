@props(['post','full'=>false])
<div class="card">
    {{-- Cover Photo --}}

    <div>
        @if ($post->image)
        <img src="{{asset('storage/' . $post->image)}}" alt="" >
        @else
        <img src="{{asset('storage/default.jpg')}}" alt="" >

        @endif

    </div>
    {{-- Title --}}
    <h2 class="font-bold text-xl">{{ $post-> title}}</h2>
    {{-- Author and Date --}}
    <div class="text-xs font-light mb-4">
        <span>
            Posted {{$post->created_at->diffForHumans()}} by
        </span>
        <a href="{{route('posts.user',$post->user)}}" class="text-blue-500 font-medium">{{$post->user->username}}</a>
    </div>
    {{-- Body --}}
    @if ($full)
    <div class="text-sm">
        <span>{{$post->body}}</span>
    </div>

    @else
    <p>{{Str::words($post->body,15,)}}</p>
    <a href="{{route('posts.show',$post)}}">Read more &rarr;</a>
    @endif
<div class="flex items-center jusify-end gap-4 mt-6">
    {{$slot}}
</div>
</div>
