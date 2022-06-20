<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- application name -->
    <title>Documentation</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .row {
            width: 1200px;
            display: grid;
            height: 100vh;
            grid-gap: 24px;
            margin: 0 auto;
            max-width: 100vh;
            padding: 1rem 0rem;
            grid-template-columns: 250px auto;
        }

        .sidebar {
            flex: 1;
            padding: 1rem;
            background: #ebedee;
            border-radius: 14px;
        }

        .sidebar>h1 {
            font-weight: 600;
            font-size: 1.5rem;
            text-transform: capitalize;

        }

        .content {
            padding: 1rem;
        }

        @media(max-width: 1200px) {
            .row {
                width: 100%;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div class="row">
        <div class="sidebar">
            <h1>Route List</h1>
            @if (count($routes) > 0)
            @foreach ($routes as $value)
            <p>{{$value}}</p>
            @endforeach
            @endif
        </div>
        <div class="content"></div>
    </div>
</body>

</html>