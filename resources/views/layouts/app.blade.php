<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - App</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div class="m-2">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div>@yield('content')
        </div>
    </div>

</body>

</html>
