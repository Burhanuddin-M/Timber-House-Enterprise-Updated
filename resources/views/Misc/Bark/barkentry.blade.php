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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

    <title>Showing number plates</title>
    <style>
        /* Additional CSS styles can be added here */
        /* Mobile Styles */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
        /* Border for all sides of each table cell */
        table td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

    @if (session('success'))
    <div class="alert alert-success text-center">
        &#9989; {{ session('success') }}
    </div>
    @endif

    @if (session('fail'))
    <div class="alert alert-danger text-center">
        &#9888; {{ session('fail') }}
    </div>
    @endif

    <div class="container"><br>
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary"><a href="{{route('bark.index')}}"
                    class="text-decoration-none text-white">&#8592;</a></button>
        </div><br>
        <h3 class="text-center text-primary">Make Bark/Peeling Entries</h3><br>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Barks as $Bark)
                    <form action="{{ route('bark.entrypost') }}" method="POST">
                        @csrf
                        <tr>
                            <input type="hidden" name="bark_id" value="{{ $Bark->id }}">
                            <td>{{ $Bark->name }}</td>
                            <td><input type="date" name="date" value="{{ date('Y-m-d') }}" required class="form-control"></td>
                            <td>
                                <select  name="type" required>
                                    <option selected disabled>Select</option>
                                    <option value="short">Short</option>
                                    <option value="long">Long</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" name="quantity" required></td>
                            <td><button type="submit" class="btn btn-sm btn-success">Submit</button></td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="table-responsive">
             <table class="table table-stripped" style="border:1px solid black">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody style="border:1px solid black;">
                    @php
                        $totals = []; // Initialize an array to store totals for each date and employee
                    @endphp
                    @foreach($Barks as $Bark)
                        @foreach($Bark->barkentry as $barkentry)
                            @php
                                $date = \Carbon\Carbon::parse($barkentry->date)->format('jS M y');
                                $employee = $Bark->name;
                                $type = $barkentry->type;
                                $total = $barkentry->total;
            
                                // Initialize total to 0 if not already set
                                if (!isset($totals[$date][$employee])) {
                                    $totals[$date][$employee] = 0;
                                }
            
                                // Add total to the appropriate type based on the type of entry
                                if ($type === 'long' || $type === 'short') {
                                    $totals[$date][$employee] += $total;
                                }
                            @endphp
                        @endforeach
                    @endforeach
            
                    {{-- Output totals --}}
                    @foreach($totals as $date => $employees)
                        @foreach($employees as $employee => $total)
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $employee }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
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
