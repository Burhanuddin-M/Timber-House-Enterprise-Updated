<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Timber House Enterprise</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }
        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 28px;
            }
            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Page Not Found</h1>
        <p>We couldn't find the page you're looking for.</p>
        <p>Please check the URL or go back to the <a href="{{route('dashboard')}}">homepage</a>.</p>
    </div>
</body>
</html>
