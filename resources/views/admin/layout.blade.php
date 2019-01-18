<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | ': '' .config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">
    <el-container>
        <el-header>
            <nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <a role="button" class="navbar-burger burger " aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbarMenu" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="{{ route('admin.plan.index') }}">
                            {{ __('Plan') }}
                        </a>

                        <a class="navbar-item" href="{{ route('admin.problem.index') }}">
                            {{ __('Problem') }}
                        </a>

                        <a class="navbar-item" href="{{ route('admin.student.index') }}">
                            {{ __('Student') }}
                        </a>

                        <a class="navbar-item" href="{{ route('admin.category.index') }}">
                            {{ __('Category') }}
                        </a>

                        <a class="navbar-item" href="{{ route('admin.user.index') }}">
                            {{ __('User') }}
                        </a>


                    </div>

                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div class="buttons">
                                @guest
                                    <a class="navbar-item is-light" href="{{ route('login_page') }}">
                                        Log in
                                    </a>
                                @else
                                    <p> Welcome you: {{is_null(Auth::user()->nickname) ? Auth::user()->nickname : Auth::user()->username }} </p>
                                    <a class="navbar-item is-primary" href="{{ route('logout') }}">
                                        Log out
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </el-header>

        <el-main>
            @yield('main')
        </el-main>

        <el-footer id="footer">
            <p>© 2018 - SDIBT Step Training - <a href="https://github.com/sdibtacm/steptraining" target="_blank"> Github </a></p>
            <p>run in {{ printf("%.5f", microtime(true) - LARAVEL_START) }} in seconds.</p>
            <p>Powered by <a target="_blank" href="https://boxjan.com"> Boxjan </a> &amp; <a href="https://github.com/sdibtacm"> SDIBT ACM Team </a></p>
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

            };
        },
        methods: {

        }
    })
</script>
</html>
