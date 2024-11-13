

<x-layout>
    <h1>Latest Post Posts</h1>
    {{-- <img src="{{asset('storage/posts_images/DqS6myQVDmk9bnoteKJuQicaFHnGANREjcr6SGdy.png')}}" alt=""> --}}
    {{-- <p>{{$posts}}</p> --}}
    <div class="grid grid-cols-2 ga">
    @foreach ($posts as $post )
    <x-postCard :post="$post"/>
    @endforeach
</div>
<div>
    {{$posts->links()}}
</div>
 </x-layout>
