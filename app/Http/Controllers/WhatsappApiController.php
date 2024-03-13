<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cheque;
use Carbon\Carbon;
use TCPDF;



class WhatsappApiController extends Controller
{
    public function cheque()
{
    // Get the current date
    $currentDate = Carbon::now()->toDateString();

    // Query the 'cheque' table for records with due_date equal to the current date
    $cheques = Cheque::whereDate('due_date', $currentDate)->get();

    dd($cheques);

    // Check if there are any records
    if ($cheques->isEmpty()) {
        return "No cheques due today.";
    }

    // Initialize TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Loop through each cheque record
    foreach ($cheques as $cheque) {
        // Add a page to the PDF
        $pdf->AddPage();

        // Add the cheque images to the PDF
        $pdf->Image($cheque->cheque_front);
        $pdf->Image($cheque->cheque_back);
        $pdf->Image($cheque->adhar_front);
        $pdf->Image($cheque->adhar_back);
        $pdf->Image($cheque->bill_invoice);
        $pdf->Image($cheque->eway_bill);
    }

    // Set the directory path to save the PDF
    $pdfDirectory = public_path('cheque/pdf');

    // Create the directory if it doesn't exist
    if (!file_exists($pdfDirectory)) {
        mkdir($pdfDirectory, 0755, true);
    }

    // Generate a unique filename for the PDF
    $filename = 'cheques_' . Carbon::now()->timestamp . '.pdf';

    // Set the file path to save the PDF
    $pdfPath = $pdfDirectory . '/' . $filename;

    // Close and output PDF
    $pdf->Output($pdfPath, 'F'); // Save the PDF file

    // WhatsApp API parameters
    $number = '917202995910';
    $type = 'media';
    $message = 'Test Message';
    $media_url = url('/cheque/pdf/' . $filename); // URL to access the saved PDF
    $instance_id = '65EDD1D423FD9';
    $access_token = '65edbef37ccff';

    // Construct the URL
    $url = 'https://k1.betablaster.in/api/send';

    // Prepare the data
    $data = [
        'number' => $number,
        'type' => $type,
        'message' => $message,
        'media_url' => $media_url,
        'filename' => $filename,
        'instance_id' => $instance_id,
        'access_token' => $access_token
    ];

    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data
    ]);

    // Execute the request
    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        // Handle the error
        // For example, log the error or return an error response
        return "cURL Error: " . $error_message;
    }

    // Close cURL session
    curl_close($curl);

    // Process the response (if needed)
    // For example, you can return $response or perform further actions based on the response
    return $response;
}






}
