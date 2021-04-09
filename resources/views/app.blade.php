<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Languages -->
        @translations

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/manifest.js') }}" defer></script>
        <script src="{{ mix('js/vendor.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- Include Monolith Config -->
        {{--<script>window.config = ['resources']</script>--}}
        <!-- Build Nova Instance -->
        <script type="module" defer>window.Monolith = new CreateMonolith()</script>

        <!-- Modules Scripts -->
        @foreach (\App\Monolith::availableScripts(request()) as $name => $path)
            @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
                <script src="{!! $path !!}" type="module" defer></script>
            @else
                <script src="/modules/{{ $name }}/module.js" type="module" defer></script>
            @endif
        @endforeach

        <!-- Start Monolith -->
        <script type="module" defer>Monolith.start()</script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
