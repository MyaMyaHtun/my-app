<x-layout>
<div class="mx-auto max-w-screen-sm card">
    <form class="" action="{{ route('register') }}" method="POST">
        @csrf
        <h2 style="text-align:center; margin-bottom: 1.5rem;">Register</h2>

        <div class="mb-4">
            <label for="username">Username</label>
            <input type="text" class="input" name="username" value="{{ old('username')}}">
            @error('username')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email">Email</label>
            <input type="text" class="input" name="email" value="{{ old('email')}}" >
            @error('email')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" class="input" name="password" >
            @error('password')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="input" name="password_confirmation" >
            @error('password_confirmation')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Register</button>
    </form>

</div>
</x-layout>
