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

        <title>Timber House Enterprise</title>
    </head>
    
    <body>
        

        <div class="container"><br>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary"><a href="{{route('sagi.index')}}"
                        class="text-decoration-none text-white">&#8592;</a></button>
            </div><br>
            <div class="text-center text-primary">
                <h3>{{ $Party_name }}</h3>
            </div><br>
            <div class="container">
                <div class="text-center mb-4">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Grand Total</th>
                            <th>Payment Given</th>
                            <th>Payment Remaining</th>
                        </tr>
                        <tr>
                            <td id="grandTotal">
                                <h5>0.00</h5>
                            </td>
                            <td id="paymentGiven">
                                <h5>0.00</h5>
                            </td>
                            <td id="paymentRemaining">
                                <h5>0.00</h5>
                            </td>
                            
                        </tr>
                    </table>
                </div>
            </div><br>


            @if (session('success'))
            <div class="alert alert-success text-center">
                &#9989; {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Date</th>
                        <th>Vehicle No.</th>
                        <th>Weight</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>Freight</th>
                        <th>Grand Total</th>
                        <th>Payment Given</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Sagi->sagientry as $Entry)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $Entry->date }}</td>
                            <td>{{ $Entry->vehicle_no }}</td>
                            <td>{{ $Entry->weight }}</td>
                            <td>{{ $Entry->rate }}</td>
                            <td>{{ $Entry->total }}</td>
                            <td>{{ $Entry->freight }}</td>
                            <td>{{ $Entry->grand_total }}</td>
                            <td>{{ $Entry->payment_given }}</td>
                            <td>{{ $Entry->payment_notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        


        </div>

        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                // Fetch the values from the server-side code or wherever they are calculated
                const grandTotalValue = parseFloat({{ $GrandTotal ?? 0 }});
                const paymentGivenValue = parseFloat({{ $PaymentGiven ?? 0 }});
                const paymentRemainingValue = parseFloat({{ $PaymentRemaining ?? 0 }});
        
                // Update the content of the elements
                document.getElementById('grandTotal').innerHTML = `<h5>${grandTotalValue.toFixed(2)}</h5>`;
                document.getElementById('paymentGiven').innerHTML = `<h5>${paymentGivenValue.toFixed(2)}</h5>`;
                document.getElementById('paymentRemaining').innerHTML = `<h5>${paymentRemainingValue.toFixed(2)}</h5>`;
            });
        </script>
        

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endsection
