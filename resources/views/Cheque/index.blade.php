@extends('layout.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Add custom CSS for text size and mobile-friendliness */
        body {
            font-size: 14px; /* Set the base font size */
        }

        .table-responsive {
            overflow-x: auto; /* Enable horizontal scrolling on smaller screens */
        }

        th, td {
            white-space: nowrap; /* Prevent wrapping of table cell content */
            max-width: 150px; /* Set a maximum width for table cells */
            overflow: hidden;
            text-overflow: ellipsis; /* Display ellipsis (...) for overflowing text */
        }

        /* Adjust button padding for better mobile display */
        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem; /* Adjust button font size */
        }

        /* Adjust margin for smaller devices */
        .mt-sm-4 {
            margin-top: 1.5rem; /* Adjust margin for small devices */
        }
    </style>
</head>

<body>

    @if (session('updated'))
        <script>
            // Your existing script for displaying success message
        </script>
    @endif

    @if (session('success'))
        <script>
            // Your existing script for displaying success message
        </script>
    @endif

    <div class="container mt-sm-4">
        <button class="btn btn-primary">
            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">←</a>
        </button>
        <div class="row">
            <!-- Add Employee Button -->
            <div class="col-6 text-end">
                <a href="{{route('cheque.form')}}" class="btn btn-primary">
                    Add Cheque
                </a>
            </div>
            
        </div><br>


        <!-- Table with Edit Column -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Due Date</th>
                        <th>Name</th>
                        <th>Place</th>  
                        <th>Mobile No</th>
                        <th>Figure</th>   
                        <th>Status</th>
                        <th>Action</th>


                    </tr>
                </thead>

                <tbody>
                    @foreach ($cheque as $Data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($Data->due_date)->format('jS M Y') }}</td>
                            <td>{{ $Data->name }}</td>
                            <td>{{ $Data->place }}</td>
                            <td><a class="text-decoration-none" href="tel:{{ $Data->mobileno }}">{{ $Data->mobileno }}</a></td>
                            <td>{{ $Data->figure }}</td>   
                            <td>
                                @if($Data->status == 0)
                                    <button class="btn btn-sm btn-danger" data-ledger-id="{{ $Data->id }}">Pending</button>
                                @elseif($Data->status == 1)
                                    <button class="btn btn-sm btn-success" data-ledger-id="{{ $Data->id }}">Completed</button>
                                @endif
                            </td>
                            <td>

                                <a href="{{route('cheque.show',['id'=>$Data->id])}}" class="btn btn-sm btn-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{route('cheque.edit',['id'=>$Data->id])}}" class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            </td>
                            
                            
                                      
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        // Function to handle the delete action
        function handleDelete(ledgerId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Change status!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the actual delete action here
                    // Use ledgerId as needed, for example, in a URL for deletion
                    const deleteUrl = "{{ route('cheque.status', ':id') }}".replace(':id', ledgerId);
                    window.location.href = deleteUrl;
                }
            });
        }
    
        // Attach the click event to the buttons with classes .btn-danger and .btn-success
        document.querySelectorAll('.btn-danger, .btn-success').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const ledgerId = this.getAttribute('data-ledger-id');
                handleDelete(ledgerId);
            });
        });
    </script>

</body>

</html>
@endsection
