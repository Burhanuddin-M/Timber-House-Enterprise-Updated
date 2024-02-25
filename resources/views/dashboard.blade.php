<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-color: #f0f5ff;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .card-img-top {
            border-bottom: 1px solid #dee2e6;
        }

        .card-body {
            padding: 20px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1,
        h3 {
            text-align: center;
            color: #0077cc;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            width: 100%;
            height: 40px;
            font-size: 16px;
            background-color: #0077cc;
            border-color: #0077cc;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #005b99;
        }

        .professional-username {
            color: #3498db;
            /* Set your preferred text color */
            font-size: 24px;
            /* Set your preferred font size */
            font-weight: bold;
            /* Set your preferred font weight */
            /* Add any additional styles you want here */
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>

    <title>Timber House Enterprise</title>
</head>

<body>

    <div class="container">

        <div class="row mt-4">
            <!-- Documents Module Card -->
            <!-- Calculator Module Card -->
            <h1 class="professional-username">{{ session('username') }}</h1>

            @if (in_array('CFT', json_decode($credential->permission->permissions)))
                <div class="col-md-6 mt-2">
                    <div class="card">
                        <img src="https://cdn1.byjus.com/wp-content/uploads/2020/01/Online-free-math-calculator.jpg"
                            height="200px" alt="Products Image">
                        <div class="card-body text-center">
                            <a href="{{ route('calculator.index') }}"" class="btn btn-primary">CFT Calculator</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Attendence Module Card -->
            @if (in_array('ATTENDENCE', json_decode($credential->permission->permissions)))
                <div class="col-md-6">
                    <div class="card">
                        <img src="https://thumbs.dreamstime.com/b/woman-hand-writing-attendance-marker-blue-background-professionally-79573891.jpg"
                            class="card-img-top img-fluid" height="200px" width="200px" alt="Products Image">
                        <div class="card-body text-center">
                            <a href="{{ route('attendence.index') }}" class="btn btn-primary">Employee attendence</a>
                        </div>
                    </div>
                </div>
            @endif

            @if (in_array('DOCUMENTS', json_decode($credential->permission->permissions)))
                <div class="col-md-6">
                    <div class="card">
                        <img src="https://media.istockphoto.com/id/868379756/vector/document-or-letter-with-a-seal-vector-illustration-of-a-flat-style-with-shadow-isolated-on-a.jpg?s=612x612&w=0&k=20&c=Qj3GtMmorCEUoHqj2NYfUCBER8140m3Ai1kzPBw6noI="
                            height="200px" width="200px" class="card-img-top img-fuild" alt="Documents Image">
                        <div class="card-body text-center">
                            <a href="{{ route('showplates') }}" class="btn btn-primary">Vehicle Documents</a>
                        </div>
                    </div>
                </div>
            @endif


            <!-- Products Module Card -->
            @if (in_array('PRODUCTS', json_decode($credential->permission->permissions)))
                <div class="col-md-6">
                    <div class="card">
                        <img src="https://media.istockphoto.com/id/622323488/photo/stacked-wood-pine-timber-for-construction-buildings.jpg?s=612x612&w=0&k=20&c=4NySfnHS3WgetqJaO0t0zSiFdVA5F6vEqqNWrxYAsTk="
                            class="card-img-top img-fluid" height="200px" width="200px" alt="Products Image">
                        <div class="card-body text-center">
                            <a href="{{ route('products.admin') }}" class="btn btn-primary">Timber Products</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products Module Card -->
            @if (in_array('CHEQUE', json_decode($credential->permission->permissions)))
                <div class="col-md-6">
                    <div class="card">
                        <img src="https://www.nicepng.com/png/detail/410-4100754_cheque-comments-white-cheque-icon-png.png"
                            class="card-img-top img-fluid" height="200px" width="200px" alt="Cheque Image">
                        <div class="card-body text-center">
                            <a href="{{ route('cheque.index') }}" class="btn btn-primary">Cheque</a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="card">
                    <img src="data:image/jpeg;base64,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"
                        class="card-img-top img-fluid" height="200px" width="200px" alt="Miscelleneous Image">
                    <div class="card-body text-center">
                        <a href="{{ route('misc.index') }}" class="btn btn-primary">Miscellaneous</a>
                    </div>
                </div>
            </div>




        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->

    <script>
