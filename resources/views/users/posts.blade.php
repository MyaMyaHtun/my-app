<x-layout>
<h1 class="title">{{$user->username}}'s Posts &#9830 {{$posts->count()}}</h1>
{{-- User's Posts --}}
<div class="grid grid-cols-2 ga">
    @foreach ($posts as $post )
    <x-postCard :post="$post"/>
    @endforeach
</div>
<div>
    {{$posts->links()}}
</div>
</x-layout>
