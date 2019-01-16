<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">
    <el-container>
        <el-header>
            <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" >

                </el-submenu>

            </el-menu>

        </el-header>

        <el-main>
            @yield('main')
        </el-main>

        <el-footer id="footer">
            © 2018 - SDIBT Step Training - <a href="https://github.com/sdibtacm/steptraining" target="_blank"> Github </a><br>
            run in {{ printf("%.5f", microtime(true) - LARAVEL_START) }} in seconds.<br>
            Powered by <a target="_blank" href="https://boxjan.com"> Boxjan </a> &amp; <a href="https://github.com/sdibtacm"> SDIBT ACM Team </a><br>
            Driven by <a href="https://laravel.com/"> Laravel </a>, <a target="_blank" href="https://vuejs.org/"> Vue </a>,
            <a target="_blank" href="https://element.eleme.io/"> Element </a>
        </el-footer>
    </el-container>
</div>

</body>



@yield('script')
<script>
    new Vue({
        mixins: [data],
        el: '#app',
        data: function() {
            return {
                activeIndex: "{{ $choose }}",
                @yield('js-data')

            };
        },
        methods: {

        }
    })
</script>
</html>
