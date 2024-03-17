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
    </style>
</head>

<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <form action="{{ route('bark.showreport', ['id' => $id]) }}" method="POST">
                @csrf
                <!-- Date selection fields -->
                <div class="mb-3">
                    <label for="fromDate" class="form-label">From:</label>
                    <input type="date" class="form-control" id="fromDate" name="start_date" value="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-3">
                    <label for="toDate" class="form-label">To:</label>
                    <input type="date" class="form-control" id="toDate" name="end_date" value="{{ date('Y-m-d') }}">
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
