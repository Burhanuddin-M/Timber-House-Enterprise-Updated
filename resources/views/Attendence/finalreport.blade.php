@extends('layout.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports of the Employee</title>
        <!-- Include necessary stylesheets and scripts here -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

        <style>
            body {
                padding-top: 20px;
                font-size: 14px;
            }

            .container {
                padding: 20px;
                overflow-x: auto;
                /* Enable horizontal scroll on small screens */
            }

            h2 {
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                margin-top: 20px;
                /* Add spacing on top of the table */
                border-collapse: collapse;
            }

            th,
            td {
                text-align: center;
                padding: 8px;
                border: 1px solid #ddd;
                /* Add borders to cells */
            }

            /* Add some spacing and styling to the buttons */
            .dt-buttons {
                margin-top: 20px;
            }

            .btn-pdf,
            .btn-print,
            .btn-primary {
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-pdf {
                background-color: #dc3545 !important;
                color: #ffffff !important;
            }

            .btn-print {
                background-color: #007bff !important;
                color: #ffffff !important;
            }

            @media only screen and (max-width: 600px) {

                /* Add specific styles for smaller screens */
                th,
                td {
                    font-size: 12px;
                }

                .btn-pdf,
                .btn-print,
                .btn-primary {
                    font-size: 12px;
                }
            }
        </style>
    </head>

    <body>

        <div class="container">
            
            <button class="btn btn-primary btn-block">
                <a href="{{ route('attendence.index') }}" class="text-white text-decoration-none">Back</a>
            </button><br>

            <h2 class="text-center text-primary">{{ $employeeData->name }}'s Report</h2>
            <div class="table-responsive">
                <table id="example" class="display nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Present</th>
                            <th class="text-center">Overtime</th>
                            <th class="text-center">Withdraw</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            use Carbon\Carbon;
                            $temp_date = $start_date;
                            $cross = '<div>&#10060</div>';
                        @endphp

                        @while ($temp_date->lessThanOrEqualTo($end_date) && $temp_date->lessThanOrEqualTo(Carbon::now()))
                            <tr>
                                @if (count($attendance) > 0)
                                    @if ($temp_date->equalTo(Carbon::parse($attendance[0]['date'])))
                                        <td>{{ Carbon::parse($attendance[0]['date'])->format('jS M Y') }}</td>
                                        <td class="fw-bold">
                                            @if ($attendance[0]['is_half_day'] == 1)
                                                1/2
                                            @else
                                                {{ $attendance[0]['type'] == 'PRESENT' ? 'P' : 'A' }}
                                            @endif
                                        </td>
                                        <td>{{ $attendance[0]['extra_hours'] }}</td>
                                        {{-- <td>{{ $attendance[0]['total_amount'] }}</td> --}}
                                        <td>
                                            @php
                                                $withdrawForDate = $date_withdraw
                                                    ->filter(function ($item) use ($temp_date) {
                                                        return Carbon::parse($item->created_at)->isSameDay($temp_date);
                                                    })
                                                    ->first();
                                            @endphp
                                            @if ($withdrawForDate)
                                                {{ $withdrawForDate->amount }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        @php
                                            array_shift($attendance);
                                        @endphp
                                    @else
                                        <td>{{ Carbon::parse($temp_date)->format('jS M Y') }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                @else
                                    <td>{{ Carbon::parse($temp_date)->format('jS M Y') }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                            </tr>
                            @php
                                $temp_date = $temp_date->addDay();
                            @endphp
                        @endwhile
                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="text-center @if ($employeeData->amount_portfolio < 0) text-danger @else text-success @endif">
                                <h5>({{ '₹ ' . number_format(round($employeeData->amount_portfolio)) }})</h5>
                            </td>
                            <td class="text-center"><b>{{ $total_present }}</b></td>
                            <td class="text-center"><b>{{ $total_overtime }}</b></td>
                            <td class="text-center"><b>{{ $total_withdraw }}</b></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="mt-3">
                    <button id="shareToWhatsApp" class="btn btn-success">Share to WhatsApp</button>
                </div>
            </div>
        </div>
       
        <script>
            $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'pdf',
                footer: true,
                text: 'DOWNLOAD AS A PDF',
                className: 'btn-pdf',
                filename: 'Report_of_{{ $employeeData->name }}_{{ $date }}', // Custom filename
                customize: function(doc) {
                    // Add custom header to the PDF
                    doc.content.unshift({
                        text: 'Report of ' + '{{ $employeeData->name }}' +
                            ' as per ' + '{{ $date }}',
                        margin: [15, 15, 0, 0],
                        fontSize: 12,
                        bold: true
                    });
                }
            },
            {
                extend: 'print',
                text: 'CLICK TO PRINT',
                className: 'btn-print',
                customize: function(win) {
                    // Add custom header to the print version
                    $(win.document.body).find('h2').text('Employee Report - ' +
                        '{{ $employeeData->name }}');
                }
            }
        ],
        searching: false, // Disable search feature
        pageLength: -1, // Display all records initially
        footer: true,
        ordering: false,
    });
});

        </script>


<script>
    // Function to handle WhatsApp sharing with a specific link
    function shareToWhatsApp() {
        // Replace {id} with the actual value you want to include
        var id = {{$employeeData->id}};
        var date = '{{$date}}'; // Replace with the actual date or retrieve it dynamically
        var specificLink = 'https://scruxoman.com/attendece/myreportfinal/' + id + '?date=' + date;

        // Create a WhatsApp share link with the specified URL
        var whatsappLink = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(specificLink);

        // Open the WhatsApp share link in a new window or tab
        window.open(whatsappLink, '_blank');
    }

    // Attach click event to the "Share to WhatsApp" button
    document.getElementById('shareToWhatsApp').addEventListener('click', shareToWhatsApp);
</script>




    </body>

    </html>

@endsection
