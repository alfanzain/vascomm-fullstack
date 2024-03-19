<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'serif': ['Playfair Display', 'ui-sans-serif', 'system-ui'],
                }
            }
        }
    </script>
    <title>Vascomm</title>
</head>

<body>
    <x-landing.header />

    <div class="container mx-auto px-[140px]">
        {{ $slot }}
    </div>

    <x-landing.footer />

    @stack('scripts')
</body>

</html>