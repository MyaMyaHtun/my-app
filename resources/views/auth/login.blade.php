<x-layout>
    <div class="mx-auto max-w-screen-sm card">
        <form class="" action="{{ route('login') }}" method="POST">
            @csrf
            <h2 style="text-align:center; margin-bottom: 1.5rem;">Welcome back</h2>


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
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            @error('failed')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <button type="submit" class="submit-btn">Login</button>
        </form>

    </div>
    </x-layout>
