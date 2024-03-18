@extends('layout.app')

@section('content')
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

            @if (in_array('TURNOVER', json_decode($credential->permission->permissions)))
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="https://www.cheggindia.com/wp-content/uploads/2023/06/What-is-Turnover-in-Business-its-Impact.png"
                                class="card-img-top img-fluid" height="200px" width="200px" alt="Miscelleneous Image">
                            <div class="card-body text-center">
                                <a href="{{ route('turnover.index') }}" class="btn btn-primary">Turnover</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            @if (in_array('NILGIRI', json_decode($credential->permission->permissions)))
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="https://sarkaripariksha.com/daily-news-images/1697435488-news.jpeg"
                                class="card-img-top img-fluid" height="200px" width="200px" alt="Miscelleneous Image">
                            <div class="card-body text-center">
                                <a href="{{ route('sagi.index') }}" class="btn btn-primary">Nilgiri/Saga</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            @if (in_array('TURNOVER', json_decode($credential->permission->permissions)))
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="https://www.shutterstock.com/image-photo/bark-peeling-tree-carbillino-galicia-600nw-2254808671.jpg"
                                class="card-img-top img-fluid" height="200px" width="200px" alt="Miscelleneous Image">
                            <div class="card-body text-center">
                                <a href="{{ route('bark.index') }}" class="btn btn-primary">Bark Peeling</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
        @endsection
