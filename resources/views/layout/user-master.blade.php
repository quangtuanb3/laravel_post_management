<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('../layout/head')
</head>

<body>
    @include('../layout/header')

    @include('../layout/alert')

    <div style="clear: both"></div>
    <section style="min-height: 70vh">
        @yield('content')
    </section>


    @include('../layout/footer')

    @include('../layout/foot')
</body>

</html>
