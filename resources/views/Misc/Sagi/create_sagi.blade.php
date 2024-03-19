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

        <!-- Custom CSS -->
        <style>
            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            @media (max-width: 576px) {
                .btn-primary {
                    margin-bottom: 10px;
                }
            }
        </style>
    </head>

    <body>

        <div class="container"><br>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary"><a href="{{ route('sagi.index') }}"
                        class="text-decoration-none text-white">&#8592;</a></button>
            </div><br>

            <div class="text-center text-primary">
                <h3>{{ $Party_name }}</h3>
            </div><br>
            <form action="{{ route('sagi.create.post', ['id' => $id]) }}" method="POST">
                @csrf
                <div class="container">
                    {{-- <div class="text-center mb-4">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Grand Total</th>
                            <th>Payment Given</th>
                            <th>Payment Remaining</th>
                        </tr>
                        <tr>
                            <td id="grandTotal"><h5>0.00</h5></td>
                            <td id="paymentGiven"><h5>0.00</h5></td>
                            <td id="paymentRemaining"><h5>0.00</h5></td>
                        </tr>
                    </table>
                </div> --}}
                </div><br>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SR.</th>
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
                                    <td>{{ $loop->index + 1 }}</td>
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

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th>SR No.</th> --}}
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
                    <tbody id="tableBody">
                        <!-- Rows will be dynamically added here -->
                    </tbody>

                </table>

                <button type="button" class="btn btn-primary" id="addRow">Add Row</button>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>



        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        {{-- <td><input type="text" class="form-control" name="srno[]" readonly></td> --}}
        <!-- JavaScript for adding rows dynamically and calculations -->
        <script>
            document.getElementById('addRow').addEventListener('click', function() {
                var tableBody = document.getElementById('tableBody');
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
    <td><input type="date" name="date[]" style="width: 100px;" value="{{ \Carbon\Carbon::now()->toDateString() }}"></td>

        <td><input type="text" class="vehicleno" name="vehicleno[]" style="width: 100px;"></td>
        <td><input type="text" class="weight" name="weight[]" style="width: 100px;"></td>
        <td><input type="text" class="rate" name="rate[]" style="width: 100px;"></td>
        <td><input type="text" class="total" name="total[]" readonly style="width: 100px;"></td>
        <td><input type="text" class="freight" name="freight[]" style="width: 100px;"></td>
        <td><input type="text" class="grandtotal" name="grandtotal[]" readonly style="width: 100px;"></td>
        <td><input type="text" class="paymentgiven" name="paymentgiven[]" style="width: 100px;"></td>
        <td><input type="text" name="notes[]" style="width: 150px;"></td>
    `;
                tableBody.appendChild(newRow);
                calculateGrandTotal();
            });


            // Function to calculate grand total and update it live
            function calculateGrandTotal() {
                var grandTotal = 0;
                var totalPaymentGiven = 0;
                var rows = document.querySelectorAll('#tableBody tr');
                rows.forEach(function(row) {
                    var weight = parseFloat(row.querySelector('.weight').value) || 0;
                    var rate = parseFloat(row.querySelector('.rate').value) || 0;
                    var total = weight * rate;
                    var freight = parseFloat(row.querySelector('.freight').value) || 0;
                    var grandtotal = total - freight;
                    var paymentGiven = parseFloat(row.querySelector('.paymentgiven').value) || 0;
                    row.querySelector('.total').value = total.toFixed(2);
                    row.querySelector('.grandtotal').value = grandtotal.toFixed(2);
                    grandTotal += grandtotal;
                    totalPaymentGiven += paymentGiven;
                });
                document.getElementById('grandTotal').innerHTML = '<h5>' + grandTotal.toFixed(2) + '</h5>';
                document.getElementById('paymentGiven').innerHTML = '<h5>' + totalPaymentGiven.toFixed(2) + '</h5>';
                var paymentRemaining = grandTotal - totalPaymentGiven;
                document.getElementById('paymentRemaining').innerHTML = '<h5>' + paymentRemaining.toFixed(2) + '</h5>';
            }

            // Event listener for input changes
            document.getElementById('tableBody').addEventListener('input', function(e) {
                calculateGrandTotal();
            });

            // Autogenerate SR numbers
            var srNo = 1;
            document.getElementById('addRow').addEventListener('click', function() {
                var srNoInputs = document.getElementsByName('srno[]');
                srNoInputs[srNoInputs.length - 1].value = srNo++;
            });
        </script>
    @endsection
