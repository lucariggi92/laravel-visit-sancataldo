<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield("title")</title>
</head>
<body>
    <div class="container">
       @yield("title")
        </div>
    
        @yield("contenuto")
</body>
</html>