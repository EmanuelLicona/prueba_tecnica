<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" rel="stylesheet"
        integrity="sha384-ZVBvXH2IGOw6fHIntvmU2wOUGWutDViMwSQwdGEvaJkHVvm1S8N/HE/zBK91NXSV" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css" rel="stylesheet"
        integrity="sha384-WnU9UKIFykmC5nUngG4IGkdl3+/E5Rx7JmiggfjyAY804EuDkGcxL4aJMdN5iuTJ" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title')</title>
</head>

<body>

    @include('layouts._partials.nav')
    @include('layouts._partials.messages')
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"
        integrity="sha384-gGekiWQ/bm8p71RTsvhPShoIBxcf8BsVjRTi0WY8FvxuQa2nKS0PKHiSXV9nfW/A" crossorigin="anonymous">
    </script>
    
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"
        integrity="sha384-wCLG3FbyFPnMZM65D+pam9KW+2joK88dh4jfSMK0OuMQ2cBQHV0t55OqmQduaQ1S" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
</body>

</html>
