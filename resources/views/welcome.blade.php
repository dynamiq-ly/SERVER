<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- application name -->
    <title>Smarhotel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        *,
        *::after,
        *::before {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            width: 100%;
            height: 100vh;
            background: linear-gradient(245deg, hsl(350deg 33% 93%) 0%, hsl(227deg 52% 94%) 33%, hsl(227deg 52% 94%) 67%, hsl(350deg 33% 93%) 100%)
        }

        .section {
            width: 1000px;
            display: grid;
            margin: 0 auto;
            padding-top: 8%;
            align-items: center;
            grid-template-columns: auto auto;
        }

        .column-1 {
            width: 40rem;
            display: flex;
            grid-gap: 24px;
            padding: 0rem 1rem;
            padding-bottom: 17%;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .column-1>h1 {
            font-weight: 700;
            font-size: 2.5rem;
            line-height: 2.8rem;
            text-transform: capitalize;
        }

        .column-1>p {
            color: #4b5563;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .column-2 {
            width: 18rem;
        }

        @media (max-width: 1010px) {
            .section {
                width: 100%;
            }
        }
    </style>
</head>

<body class="antialiased">
    <section class="section">
        <div class="column-1">
            <h1 class="heading">smarhotel makes your stay simply brilliant.</h1>
            <p>Smarhotel is a crossplatform hotel management system. that will help you bring you the best experience of hotel management. from managing rooms and guests to booking and managing reservations.</p>
            <a href="/docs" type="button" style="font-weight:500;" class="border capitalize border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                discover our api
            </a>
        </div>
        <div class="column-2">
            <img src="https://nine4-2.vercel.app/images/iPhone-12-Mockup.png" alt="iphone mockup">
        </div>
    </section>
</body>

</html>