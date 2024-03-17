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

    <body><br>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>

                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Short</th>
                            <th>Long</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Barks as $bark)
                            @php
                                $longTotal = 0;
                                $shortTotal = 0;
                            @endphp

                            @foreach ($bark->barkentry as $barkentry)
                                @php
                                    if ($barkentry->type == 'short') {
                                        $shortTotal += $barkentry->total;
                                    } elseif ($barkentry->type == 'long') {
                                        $longTotal += $barkentry->total;
                                    }
                                @endphp
                            @endforeach

                            @if ($longTotal > 0 || $shortTotal > 0)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($barkentry->date)->format('jS M y') }}</td>
                                    <td>{{ $bark->name }}</td>
                                    <td>{{ $shortTotal }}</td>
                                    <td>{{ $longTotal }}</td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
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
