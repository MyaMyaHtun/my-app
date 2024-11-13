@props(['msg','bg'=>'bg-green-500'])

{{-- <P class=" mb-2 text-sm font-medium text-white bg-green-500 px-3 py-rounded-md">
{{$msg}};
</P> --}}
@props(['msg', 'bg' => 'bg-green-500'])

<p class="mb-2 text-sm font-medium text-white {{ $bg }} px-3 py-2 rounded-md">
    {{ $msg }}
</p>

