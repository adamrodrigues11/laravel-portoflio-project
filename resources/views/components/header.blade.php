<header class="px-6 py-8 bg-white dark:bg-black">
    <nav class="md:flex md:justify-between md:items-center">
        <div><a href="/" class="text-s font-bold uppercase">Home</a></div>
        <div class="mt-8 md:mt-0">
            <a href="/projects" class="ml-3 text-xs font-bold uppercase">Projects</a>
            <a href="/about" class="ml-3 text-xs font-bold uppercase">About</a>
        </div>
        <div class="mt-4 md:mt-0">
            @auth
                <span class="text-xs font-bold uppercase"> {{ auth()->user()->name }} </span>
                @if (auth()->user()->isAdmin())
                    <a href="/admin" class="ml-4 text-s font-bold uppercase">Admin</a>
                @endif
                <a href="/logout" class="ml-3 text-xs font-bold uppercase">Logout</a>
            @else
                <a href="/register" class="ml-3 text-xs font-bold uppercase">Register</a>
                <a href="/login" class="ml-3 text-xs font-bold uppercase">Log In</a>
            @endauth
        </div>
    </nav>
    @if (session()->has('success'))
        <div class="md:flex md:justify-center md:items-center">
            <p class="text-xs font-bold uppercase border border-green-700 rounded px-4 py-2">
                {{ session()->get('success')}}
            </p>
        </div>
    @elseif (session()->has('error'))
        <div class="md:flex md:justify-center md:items-center">
            <p class="text-xs font-bold uppercase border border-red-700 rounded px-4 py-2">
                {{ session()->get('error')}}
            </p>
        </div>
    @endif
</header>