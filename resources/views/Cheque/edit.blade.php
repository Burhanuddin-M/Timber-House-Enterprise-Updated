@extends('layout.app')
@section('content')

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      /* Custom Styles */
      body {
        background-color: #f8f9fa;
      }

      .container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }

      .form-group label {
        font-weight: bold;
      }

      .form-control {
        border-radius: 0; /* Remove border-radius */
      }

      .btn-primary {
        border-radius: 0; /* Remove border-radius */
      }

      /* Custom file input style */
      .custom-file-input {
        color: transparent;
      }

      .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
      }

      .custom-file-input::before {
        content: 'Choose File';
        display: inline-block;
        background: #007bff;
        color: white;
        border-radius: 3px;
        padding: 5px 10px;
        outline: none;
        white-space: nowrap;
        cursor: pointer;
      }

      .custom-file-input:hover::before {
        background: #0056b3;
      }

      .custom-file-input:active::before {
        background: #0056b3;
      }

      .custom-file-input:focus::before {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      }
    </style>

    <title>Cheque Form</title>
  </head>
  <body>
    
    <div class="container mt-5">
      <h1 class="text-center mb-4">Cheque Form Update</h1>
      <form action="{{ route('cheque.update', ['id' => $cheque->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="date">Due Date:</label>
              <input type="date" class="form-control" id="date" name="date" value="{{$cheque->due_date}}">
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$cheque->name}}">
            </div>
            <div class="form-group">
              <label for="mobile">Mobile No:</label>
              <input type="number" class="form-control" id="mobile" name="mobile" value="{{$cheque->mobileno}}">
            </div>
            <div class="form-group">
              <label for="place">Place:</label>
              <input type="text" class="form-control" id="place" name="place" value="{{$cheque->place}}">
            </div>
            <div class="form-group">
              <label for="figure">Figure:</label>
              <input type="number" class="form-control" id="figure" name="figure" value="{{$cheque->figure}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="note">Note:</label>
              <textarea class="form-control" id="note" rows="5" name="note">{{$cheque->note}}</textarea>
            </div>
            <div class="form-group">
              <label for="cheque_front">Cheque Front Image:</label><br>
              <img src="{{ asset($cheque->cheque_front) }}" class="img-fluid" alt="Cheque Front">
              <label class="custom-file-input">
                <input type="file" id="cheque_front" name="cheque_front">
              </label>
            </div>
            <div class="form-group">
              <label for="cheque_back">Cheque Back Image:</label><br>
              <img src="{{ asset($cheque->cheque_back) }}" class="img-fluid" alt="Cheque Back">
              <label class="custom-file-input">
                <input type="file" id="cheque_back" name="cheque_back">
              </label>
            </div>
            <div class="form-group">
              <label for="adhar_front">Adhar Front Image:</label><br>
              <img src="{{ asset($cheque->adhar_front) }}" class="img-fluid" alt="Cheque Front">
              <label class="custom-file-input">
                <input type="file" id="adhar_front" name="adhar_front">
              </label>
            </div>
            <div class="form-group">
              <label for="adhar_back">Adhar Back Image:</label><br>
              <img src="{{ asset($cheque->adhar_back) }}" class="img-fluid" alt="Cheque Front">
              <label class="custom-file-input">
                <input type="file" id="adhar_back" name="adhar_back">
              </label>
            </div>
            <div class="form-group">
              <label for="bill_invoice">Bill Invoice Image:</label><br>
              <img src="{{ asset($cheque->bill_invoice) }}" class="img-fluid" alt="Cheque Front">
              <label class="custom-file-input">
                <input type="file" id="bill_invoice" name="bill_invoice">
              </label>
            </div>
            <div class="form-group">
              <label for="eway_bill">Eway Bill Image:</label><br>
              <img src="{{ asset($cheque->eway_bill) }}" class="img-fluid" alt="Cheque Front">
              <label class="custom-file-input">
                <input type="file" id="eway_bill" name="eway_bill">
              </label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

@endsection
