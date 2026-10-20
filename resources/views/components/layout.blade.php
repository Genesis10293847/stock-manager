<!DOCTYPE html>
<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex items-center gap-4">
            @auth
            <span class="text-sm text-gray-600">
                signed in as {{ auth()->user()->name }}
            </span>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:underline">
                    Log out
                </button>
            </form>
            @else
            {{-- <a href="{{route('login')}}" class="text-sm text-gray-600 hover:underline">
                Log in
            </a>
            <a href="{{route('register')}}" class="text-sm text-gray-600 hover:underline">
                Register
            </a> --}}
            @endauth
        </div>
        <main class = "max-w-2x1 mx-auto py-8 px-4"><!-- main.max-w-2x1.mx-auto.py-8.px-4 -->
            {{  $slot  }}
        </main>
    </body>
</html>
{{--   git config --global user.email "20187546@s.ubaguio.edu"
  git config --global user.name "Genesis10293847" --}}
