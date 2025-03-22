<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.css" rel="stylesheet"
        integrity="sha384-M6C9anzq7GcT0g1mv0hVorHndQDVZLVBkRVdRb2SsQT7evLamoeztr1ce+tvn+f2" crossorigin="anonymous">

    <title>@yield('title')</title>

    <style>
        :root {
            --custom-color-blue: #202f62;
        }
    </style>
</head>

<body style="background-color: var(--custom-color-blue);">

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js"
        integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous">
    </script>


    @yield('scripts')
</body>

</html>
