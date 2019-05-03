<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-18 20:06
 */
?>

<!doctype html>
<html lang="en">
<head>
    <title>Page Not Found</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Styles -->
    <link type="text/css" href="{{ asset('css/error.css') }}" rel="stylesheet">
</head>
<body class="antialiased font-sans">
<div class="md:flex min-h-screen">
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
        <div class="max-w-sm m-8">
            <div class="text-black text-5xl md:text-15xl font-black">
                {{ $error }}                    </div>

            <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

            <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                {{ $message }}                    </p>

            <a href="{{ route('home') }}">
                <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                    Go Home
                </button>
            </a>
        </div>
    </div>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        <div class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center" id="background">
        </div>
    </div>
</div>
</body>
</html>
<!-- {{ printf("%.6f", microtime(true)  - LARAVEL_START ) }} -->
