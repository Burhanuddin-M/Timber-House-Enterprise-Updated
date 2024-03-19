<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sagientry;
use App\Models\Sagi;
use App\Models\bark;
use App\Models\barkentry;
use App\Models\credentials;

class MiscController extends Controller
{
    public function index()
    {
        $credential = credentials::with(['permission'])->findOrFail(session('user_id'));
        return view('Misc.index',compact('credential'));
    }

    public function turnover_index()
    {
        // return view('Misc.Turnover.index');
        //under maintenace
        return view('Errors.maintenance');
    }

    public function sagi_index()
    {
    
        $Sagis = sagi::all();
        return view('Misc.Sagi.index', compact('Sagis'));

        //under maintenace
        return view('Errors.maintenance');
    }

    public function sagi_post(Request $request)
    {


        $PartyName = $request->party_name;

        $Sagi = new sagi();
        $Sagi->party_name = $PartyName;

        $Sagi->save();

        return redirect('/Misc/Sagi/index')->with('success', 'Party Name added successfully');
    }

    public function sagi_create($id)
    {
        $Sagi = sagi::with([
            'sagientry' => function ($query) use ($id) {
                $query->where('sagi_id', $id);
            }
        ])->find($id);
    
        $GrandTotal = $Sagi->sagientry->sum('grand_total');
   

        $Party_name = $Sagi->party_name;


        return view('Misc.Sagi.create_sagi', compact('Party_name', 'id'));


    }

    public function sagi_create_post($id, Request $request)
    {
        // Retrieve arrays from the request
        // $srnos = $request->input('srno');
        $dates = $request->input('date');
        $vehiclenos = $request->input('vehicleno');
        $weights = $request->input('weight');
        $rates = $request->input('rate');
        $totals = $request->input('total');
        $freights = $request->input('freight');
        $grandtotals = $request->input('grandtotal');
        $paymentgivens = $request->input('paymentgiven');
        $notes = $request->input('notes');

        // Loop through the arrays and create entries
        foreach ($dates as $key => $date) {
            $sagiEntry = new Sagientry();
            $sagiEntry->sagi_id = $id;
            // $sagiEntry->sr_no = $srno;
            $sagiEntry->date = $dates[$key];
            $sagiEntry->vehicle_no = $vehiclenos[$key];
            $sagiEntry->weight = $weights[$key];
            $sagiEntry->rate = $rates[$key];
            $sagiEntry->total = $totals[$key];
            $sagiEntry->freight = $freights[$key];
            $sagiEntry->grand_total = $grandtotals[$key];
            $sagiEntry->payment_given = $paymentgivens[$key];
            $sagiEntry->payment_notes = $notes[$key];

            // Additional fields assignment here if needed

            // Save the entry
            $sagiEntry->save();
        }

        // Optionally, you can redirect the user after saving
        return redirect("Misc/Sagi/show/" . $id)->with('success','Entry is done Successfully');


    }


    public function sagi_show($id)
    {
        $Sagi = sagi::with([
            'sagientry' => function ($query) use ($id) {
                $query->where('sagi_id', $id);
            }
        ])->find($id);
    
        $GrandTotal = $Sagi->sagientry->sum('grand_total');
    
        $PaymentGiven = $Sagi->sagientry->sum('payment_given');
    
        $PaymentRemaining = $GrandTotal - $PaymentGiven;
    
        $Party_name = $Sagi->party_name;
    
        return view('Misc.Sagi.show_sagi', compact('Party_name', 'Sagi', 'GrandTotal', 'PaymentGiven', 'PaymentRemaining'));
    }
    

    public function bark_index()
    {
        return view('Misc.Bark.index');
    }

    public function bark_add()
    {

        $Bark = bark::all();
        return view('Misc.Bark.addEmployee', compact('Bark'));
    }

    public function bark_post(Request $request)
    {

        $Bark = new bark();

        $Bark->name = $request->name;
        $Bark->short_rate = $request->long;
        $Bark->long_rate = $request->short;

        $Bark->save();
        return redirect('Misc/Bark/add')->with('success', 'Employee is added successfully');
    }

    public function bark_edit(Request $request, $id)
    {
        $Bark = bark::find($id);

        $Bark->name = $request->name;
        $Bark->short_rate = $request->short;
        $Bark->long_rate = $request->long;

        $Bark->save();
        return redirect('Misc/Bark/add')->with('success', 'Employee is updated successfully');
    }


    public function bark_entry()
    {

        $Barks = bark::with('barkentry')->get();

        return view("Misc.Bark.barkentry", compact('Barks'));
    }

    public function bark_entry_post(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'type' => 'required',
            'quantity' => 'required',
        ]);


        $id = $request->bark_id;
        $date = $request->date;
        $type = $request->type;
        $quantity = $request->quantity;

        $exists = Barkentry::where('bark_id', $id)
            ->where('date', $date)
            ->where('type', $type)
            ->exists();

        if ($exists) {
            return redirect('Misc/Bark/entry')->with('fail', 'Entry is Already Done');
        }

        $Bark = Bark::find($id);

        if ($type === "long") {
            $rate = $Bark->long_rate;
            $total = $quantity * $rate; // Corrected calculation for total
        } elseif ($type === "short") {
            $rate = $Bark->short_rate;
            $total = $quantity * $rate; // Corrected calculation for total
        }

        $BarkEntry = new barkentry();
        $BarkEntry->bark_id = $id;
        $BarkEntry->date = $date;
        $BarkEntry->type = $type;
        $BarkEntry->quantity = $quantity;
        $BarkEntry->rate = $rate;
        $BarkEntry->total = $total; // Assign the calculated total

        $BarkEntry->save();

        return redirect('Misc/Bark/entry')->with('success', 'Entry is Successfully Done');
    }


    public function bark_report()
    {
        $startDate = '2024-01-01'; // Your start date
        $endDate = '2024-03-31';   // Your end date
        $barkId = 8; // Assuming you have a specific bark_id
        
        $shortTotal = BarkEntry::where('type', 'short')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('bark_id', $barkId)
            ->sum('total');
        
        $longTotal = BarkEntry::where('type', 'long')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('bark_id', $barkId)
            ->sum('total');
        
        $total = $shortTotal + $longTotal;
        


        // dd($total);

        $Barks = bark::all();
        


        return view('Misc.Bark.report',compact('Barks'));
    }

    public function bark_report_show($id){
        return view('Misc.Bark.customise',compact('id'));
    }

    public function show_report($id,Request $request){
    
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $Name = bark::find($id)->name;


        
        $shortTotal = BarkEntry::where('type', 'short')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('bark_id', $id)
            ->sum('total');
        
        $longTotal = BarkEntry::where('type', 'long')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('bark_id', $id)
            ->sum('total');
        
        $total = $shortTotal + $longTotal;

        return view('Misc.Bark.output',compact('total','shortTotal','longTotal','Name','startDate','endDate'));
    }

}
