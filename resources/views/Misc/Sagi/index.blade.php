@extends('layout.app')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                max-width: 800px;
                margin: auto;
                animation: fadeIn 1s ease-in-out;
            }

            h1,
            h3 {
                color: #007bff;
            }

            .btn-primary {
                background-color: #007bff;
                border: none;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-warning {
                background-color: #ffc107;
                border: none;
            }

            .btn-warning:hover {
                background-color: #d39e00;
            }

            .modal-title {
                color: #007bff;
            }

            .btn-secondary {
                background-color: #dc3545;
            }

            .btn-secondary:hover {
                background-color: #c82333;
            }

            table {
                margin-top: 20px;
                animation: fadeIn 1s ease-in-out;
            }

            .alert {
                margin-top: 20px;
                animation: fadeIn 1s ease-in-out;
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
        </style>

        <title>Showing number plates</title>
    </head>

    <body>

        @if (session('success'))
            <div class="alert alert-success text-center">
                &#9989; {{ session('success') }}
            </div>
        @endif

        @if (session('fail'))
            <div class="alert alert-danger text-center">
                &#9989; {{ session('fail') }}
            </div>
        @endif

        <div class="container">

            <div class="row justify-content-center">
                <button type="button" class="btn btn-primary btn-sm text-dark" data-bs-toggle="modal"
                    data-bs-target="#myModal">Add Party Name</button>
            </div><br>

            @if (false)
                <h3 class="text-center text-danger">No Records Found</h3>
            @else
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">SR NO</th>
                            <th scope="col">Party Name</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Remaining</th>           
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Sagis as $Sagi)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $Sagi->party_name }}</td>
                                <td>{{ $Sagi->sagientry->sum('grand_total') }}</td>
                                <td>{{ $Sagi->sagientry->sum('payment_given') }}</td>
                                <td>{{ $Sagi->sagientry->sum('grand_total') - $Sagi->sagientry->sum('payment_given') }}</td>
                                <td>
                                    <a href="{{ route('sagi.create', ['id' => $Sagi->id]) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('sagi.show', ['id' => $Sagi->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            @endif
        </div>

        <!-- Modal to add the number plates in it.. -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new Party Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('sagi.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Party Name</label>
                                <input type="text" class="form-control" id="name" placeholder="write a party name.."
                                    name="party_name"  required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            <!-- Add more form fields as needed -->
                        </form>
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
    </body>

    </html>

@endsection
