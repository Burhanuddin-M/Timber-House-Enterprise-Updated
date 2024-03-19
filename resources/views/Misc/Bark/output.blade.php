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

    <title>Showing number plates</title>
    <style>
        /* Additional CSS styles can be added here */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
            background-color: #f8f9fa; /* Light gray background */
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.5rem;
            color: #007bff; /* Blue title */
            text-align: center;
            margin-bottom: 20px;
        }

        .card-subtitle {
            font-size: 1.2rem;
            color: #6c757d; /* Gray subtitle */
        }

        .card-text {
            font-size: 1.3rem;
            color: #28a745; /* Green text */
            font-weight: bold;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{\Carbon\Carbon::parse($startDate)->format('jS F Y')}} To {{\Carbon\Carbon::parse($endDate)->format('jS F Y')}}</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Long</th>
                                    <th scope="col">Average</th>
                                    <th scope="col">Short</th>
                                    <th scope="col">Average</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $Name }}</td>
                                    <td>{{ $longTotal }}</td>
                                    <td>{{ $longCount > 0 ? number_format($longTotal / $longCount, 2) : 0 }}</td>
                                    <td>{{ $shortTotal }}</td>
                                    <td>{{ $shortCount > 0 ? number_format($shortTotal / $shortCount, 2) : 0 }}</td>
                                    <td>{{ $total }}</td> 
                                </tr>
                            </tbody>
                        </table>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
