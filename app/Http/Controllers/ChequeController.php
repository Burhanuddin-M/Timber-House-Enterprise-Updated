<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cheque;

class ChequeController extends Controller
{
    public function index()
    {

        $cheque = cheque::all();


        return view('cheque.index', compact('cheque'));
    }

    public function status($id) {
        $cheque = Cheque::find($id);
        
        // Toggle the status value between 0 and 1
        $cheque->status = $cheque->status == 0 ? 1 : 0;
    
        $cheque->save();
    
        return redirect('/cheque/index')->with('update', 'Status Updated Successfully');
    }
    


    public function form()
    {
        return view('cheque.form');
    }

    public function show($id){

        $cheque = cheque::find($id);
        return view('cheque.show',compact('cheque'));
    }

    public function edit($id){
        $cheque = cheque::find($id);
        return view('cheque.edit',compact('cheque'));
    }

    public function upload(Request $request)
    {
        // dd($request->all());

        // Extracting date from the request
        $dueDate = $request->date;
        $name = $request->name;
        $figure = $request->figure;
        $place = $request->place;
        $note = $request->note;
        $mobile = $request->mobile;

        // Handling file uploads
        if ($request->hasFile('cheque_front')) {
            $chequeFrontImage = $request->file('cheque_front');

            // Move the file to the desired directory
            $filePathChequeFront = 'cheque/' . 'chequefront_'.$dueDate.'_'.$figure.'_'.$name.'.' . $chequeFrontImage->getClientOriginalExtension();
            $chequeFrontImage->move(public_path('cheque'), $filePathChequeFront);

        }

        if ($request->hasFile('cheque_back')) {
            $chequeBackImage = $request->file('cheque_back');

            // Move the file to the desired directory
            $filePathChequeBack = 'cheque/' . 'chequeback_'.$dueDate.'_'.$figure.'_'.$name.'.' . $chequeBackImage->getClientOriginalExtension();
            $chequeBackImage->move(public_path('cheque'), 'cheque_back.' . $filePathChequeBack);
        }

        if ($request->hasFile('adhar_front')) {
            $AdharFrontImage = $request->file('adhar_front');

            // Move the file to the desired directory
            $filePathAdharFront = 'cheque/' . 'adharfront_'.$dueDate.'_'.$figure.'_'.$name.'.' . $AdharFrontImage->getClientOriginalExtension();
            $AdharFrontImage->move(public_path('cheque'), 'adhar_front.' . $filePathAdharFront);
        }

        if ($request->hasFile('adhar_back')) {
            $AdharBackImage = $request->file('adhar_back');

            // Move the file to the desired directory
            $filePathAdharBack = 'cheque/' . 'adharback_'.$dueDate.'_'.$figure.'_'.$name.'.' . $AdharBackImage->getClientOriginalExtension();
            $AdharBackImage->move(public_path('cheque'), 'adhar_back.' . $filePathAdharBack);
        }

        if ($request->hasFile('bill_invoice')) {
            $BillInvoiceImage = $request->file('bill_invoice');

            // Move the file to the desired directory
            $filePathBillInvoice = 'cheque/' . 'billinvoice_'.$dueDate.'_'.$figure.'_'.$name.'.' . $BillInvoiceImage->getClientOriginalExtension();
            $BillInvoiceImage->move(public_path('cheque'), 'bill_invoice.' . $filePathBillInvoice);
        }

        if ($request->hasFile('eway_bill')) {
            $EwayBillImage = $request->file('eway_bill');

            // Move the file to the desired directory
            $filePathEwayBill = 'cheque/' . 'ewaybill_'.$dueDate.'_'.$figure.'_'.$name.'.' . $EwayBillImage->getClientOriginalExtension();
            $EwayBillImage->move(public_path('cheque'), 'eway_bill.' . $filePathEwayBill);
        }


        $Cheque = New Cheque();


        $Cheque->due_date = $dueDate;
        $Cheque->name = $name;
        $Cheque->mobileno = $mobile;
        $Cheque->figure = $figure;
        $Cheque->place = $place;
        $Cheque->note = $note;
        $Cheque->cheque_front = $filePathChequeFront ?? 'null';
        $Cheque->cheque_back = $filePathChequeBack ?? 'null';
        $Cheque->adhar_front = $filePathAdharFront ?? 'null';
        $Cheque->adhar_back = $filePathAdharBack ?? 'null';
        $Cheque->bill_invoice = $filePathBillInvoice ?? 'null';
        $Cheque->eway_bill = $filePathEwayBill ?? 'null';
        $Cheque->status = 0;

        $Cheque->Save();

        return redirect('/cheque/index')->with('success','Document Uploaded Successfully');




    }

    public function update(Request $request,$id)
    {
        // dd($request->all());

        // Extracting date from the request
        $dueDate = $request->date;
        $name = $request->name;
        $figure = $request->figure;
        $place = $request->place;
        $note = $request->note;
        $mobile = $request->mobile;
        $hasChequeFront = false;
        $hasChequeBack = false;
        $hasAdharFront = false;
        $hasAdharBack = false;
        $hasBillInvoice = false;
        $hasEwayBill = false;


        // Handling file uploads
        if ($request->hasFile('cheque_front')) {
            $chequeFrontImage = $request->file('cheque_front');

            // Move the file to the desired directory
            $filePathChequeFront = 'cheque/' . 'chequefront_'.$dueDate.'_'.$figure.'_'.$name.'.' . $chequeFrontImage->getClientOriginalExtension();
            $chequeFrontImage->move(public_path('cheque'), $filePathChequeFront);
            $hasChequeFront = true;

        }

        if ($request->hasFile('cheque_back')) {
            $chequeBackImage = $request->file('cheque_back');

            // Move the file to the desired directory
            $filePathChequeBack = 'cheque/' . 'chequeback_'.$dueDate.'_'.$figure.'_'.$name.'.' . $chequeBackImage->getClientOriginalExtension();
            $chequeBackImage->move(public_path('cheque'), 'cheque_back.' . $filePathChequeBack);
            $hasChequeBack = true;
        }

        if ($request->hasFile('adhar_front')) {
            $AdharFrontImage = $request->file('adhar_front');

            // Move the file to the desired directory
            $filePathAdharFront = 'cheque/' . 'adharfront_'.$dueDate.'_'.$figure.'_'.$name.'.' . $AdharFrontImage->getClientOriginalExtension();
            $AdharFrontImage->move(public_path('cheque'), 'adhar_front.' . $filePathAdharFront);
            $hasAdharFront = true;
        }

        if ($request->hasFile('adhar_back')) {
            $AdharBackImage = $request->file('adhar_back');

            // Move the file to the desired directory
            $filePathAdharBack = 'cheque/' . 'adharback_'.$dueDate.'_'.$figure.'_'.$name.'.' . $AdharBackImage->getClientOriginalExtension();
            $AdharBackImage->move(public_path('cheque'), 'adhar_back.' . $filePathAdharBack);
            $hasAdharBack = true;
        }

        if ($request->hasFile('bill_invoice')) {
            $BillInvoiceImage = $request->file('bill_invoice');

            // Move the file to the desired directory
            $filePathBillInvoice = 'cheque/' . 'billinvoice_'.$dueDate.'_'.$figure.'_'.$name.'.' . $BillInvoiceImage->getClientOriginalExtension();
            $BillInvoiceImage->move(public_path('cheque'), 'bill_invoice.' . $filePathBillInvoice);
            $hasBillInvoice = true;
        }

        if ($request->hasFile('eway_bill')) {
            $EwayBillImage = $request->file('eway_bill');

            // Move the file to the desired directory
            $filePathEwayBill = 'cheque/' . 'ewaybill_'.$dueDate.'_'.$figure.'_'.$name.'.' . $EwayBillImage->getClientOriginalExtension();
            $EwayBillImage->move(public_path('cheque'), 'eway_bill.' . $filePathEwayBill);
            $hasEwayBill = true;
        }


        $Cheque = Cheque::find($id);


        $Cheque->due_date = $dueDate;
        $Cheque->name = $name;
        $Cheque->mobileno = $mobile;
        $Cheque->figure = $figure;
        $Cheque->place = $place;
        $Cheque->note = $note;
        if($hasChequeFront){
            $Cheque->cheque_front = $filePathChequeFront ?? 'null';
        }
        if($hasChequeBack){
            $Cheque->cheque_back = $filePathChequeBack ?? 'null';      
        }
        if($hasAdharFront){
            $Cheque->adhar_front = $filePathAdharFront ?? 'null';
        }
        if($hasAdharBack){
            $Cheque->adhar_front = $filePathAdharBack ?? 'null';
        }
        if($hasBillInvoice){
            $Cheque->bill_invoice = $filePathBillInvoice ?? 'null';
        }
        if($hasEwayBill){
            $Cheque->eway_bill = $filePathEwayBill ?? 'null';
        }


        $Cheque->Save();

        return redirect('/cheque/index')->with('updated','Document Uploaded Successfully');




    }

}
