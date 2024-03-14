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
    </head>

    <body>

        @if (session('success'))
            <div class="alert alert-success text-center">
                &#9989; {{ session('success') }}
            </div>
        @endif

        <div class="container"><br>
            <h3 class="text-center text-primary">Bark Peeling Entries</h3><br>
            <form action="/submit" method="post">
                <table class="table">
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
                            
                        <tr>
                            <td>{{$Bark->name}}</td>
                            <td><input type="date" name="date" value="{{ date('Y-m-d') }}"></td>

                            <td>
                                <select class="form-select form-select-sm" name="type">
                                    <option value="long">Long</option>
                                    <option value="short">Short</option>
                                </select>
                            </td>
                            <td><input type="number" class="form-control form-control-sm" name="quantity" /></td>
                            <td><button type="submit" class="btn btn-sm btn-success">Submit</button></td>
                        </tr>
                        
                        @endforeach
                        <!-- You can add more rows as needed -->
                    </tbody>
                </table>
            </form>
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
