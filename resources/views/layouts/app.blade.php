<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Harian</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>