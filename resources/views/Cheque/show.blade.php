@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Bootstrap Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <button class="btn btn-primary">
            <a href="{{ route('cheque.index') }}" class="text-white text-decoration-none">←</a>
        </button>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="purchasedate">Purchase Date:</label>
                                    <input type="text" class="form-control" id="purchasedate"
                                        value="{{ \Carbon\Carbon::parse($cheque->created_at)->format('jS M Y') }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="duedate">Due Date:</label>
                                    <input type="text" class="form-control" id="duedate"
                                        value="{{ \Carbon\Carbon::parse($cheque->due_date)->format('jS M Y') }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name"
                                        value="{{ $cheque->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                    <div class="form-group">
                                        <!-- Added text-center class to align content center -->
                                        <label for="amount">Figure:</label>
                                        <input type="text" class="form-control" id="amount"
                                            value="{{ $cheque->figure }}" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile No:</label>
                                    <!-- Input field with readonly attribute to display the phone number -->
                                    <input type="text" class="form-control" id="mobile" value="{{ $cheque->mobileno }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="place">Place:</label>
                                    <input type="text" class="form-control" style="font-size:14px;" id="place" value="{{ $cheque->place }}" readonly>
                                </div>
                            </div>
                        </div>
                        



                        <div class="form-group">
                            <label for="note">Note:</label>
                            <textarea class="form-control" id="note" rows="3" readonly>{{ $cheque->note }}</textarea>
                        </div>

                        <div class="text-center">
                            <div class="row">
                                @if($cheque->cheque_front != 'null')
                                <div class="col-12">
                                    <h5>Cheque Front</h5>
                                    <img src="{{ asset($cheque->cheque_front) }}" class="img-fluid" alt="Cheque Front">
                                </div>
                                @endif

                                @if($cheque->cheque_back != 'null')
                                <div class="col-12">
                                    <h5>Cheque Back</h5>
                                    <img src="{{ asset($cheque->cheque_back) }}" class="img-fluid" alt="Cheque Back">
                                </div>
                                @endif

                                @if($cheque->adhar_front != 'null')
                                <div class="col-12">
                                    <h5>Aadhar Front</h5>
                                    <img src="{{ asset($cheque->adhar_front) }}" class="img-fluid" alt="Adhar Front">
                                </div>
                                @endif

                                @if($cheque->adhar_back != 'null')
                                <div class="col-12">
                                    <h5>Aadhar Back</h5>
                                    <img src="{{ asset($cheque->adhar_back) }}" class="img-fluid" alt="Adhar Back">
                                </div>
                                @endif

                                @if($cheque->bill_invoice != 'null')
                                <div class="col-12">
                                    <h5>Bill Invoice</h5>
                                    <img src="{{ asset($cheque->bill_invoice) }}" class="img-fluid" alt="Bill Invoice">
                                </div>
                                @endif

                                @if($cheque->eway_bill != 'null')
                                <div class="col-12">
                                    <h5>Eway Bill</h5>
                                    <img src="{{ asset($cheque->eway_bill) }}" class="img-fluid" alt="Eway Bill">
                                </div>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-success">Share to Whatsapp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>

<script>
    // Add click event listener to the mobile input field
    document.getElementById('mobile').addEventListener('click', function() {
        // Get the phone number value
        var phoneNumber = this.value;
        // Check if the phone number is not empty
        if (phoneNumber.trim() !== '') {
            // Construct the tel: link
            var telLink = 'tel:' + phoneNumber;
            // Navigate to the tel: link (this will initiate a call)
            window.location.href = telLink;
        }
    });
</script>


@endsection