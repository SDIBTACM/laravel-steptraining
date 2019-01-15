<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div>

        </div>
    </div>

</body>


<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
<script>
    new Vue({
        mixins: [data],
        el: '#app',
        data: function() {
            return {
                @yield('js-data')
            };
        },
        created: function () {
            console.log(this.$data)
        }
    })
</script>
</html>
