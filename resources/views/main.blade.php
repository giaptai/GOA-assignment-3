<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Layout</title>
</head>

<body>
    <main class="bg-[#f8f9fa]">
        {{-- HEADER --}}
        @include("components.header")
        <section class="flex flex-col md:flex-row min-h-[calc(100vh_-_87.98px)]">
            {{-- SIDEBAR --}}
            @include("components.sidebar")
            {{-- Main Content --}}
            <div class="px-14 py-9 w-full">
                @yield('main-content')
            </div>
        </section>
    </main>
</body>

</html>
