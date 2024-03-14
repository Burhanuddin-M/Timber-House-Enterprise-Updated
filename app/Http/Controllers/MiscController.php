<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sagientry;
use App\Models\Sagi;

class MiscController extends Controller
{
    public function index(){
        return view('Misc.index');
    }

    public function turnover_index(){
        return view('Misc.Turnover.index');
    }

    public function sagi_index(){

        $Sagis = sagi::all();
        return view('Misc.Sagi.index',compact('Sagis'));
    }

    public function sagi_post(Request $request){

    
        $PartyName = $request->party_name;

        $Sagi = New sagi();
        $Sagi->party_name = $PartyName;

        $Sagi->save();

        return redirect('/Misc/Sagi/index')->with('success','Party Name added successfully');
    }

    public function sagi_create($id){
        $Sagi = sagi::find($id);

        $Party_name = $Sagi->party_name;
    

        return view('Misc.Sagi.create_sagi',compact('Party_name','id'));

        
    }

    public function sagi_create_post($id, Request $request) {
        // Retrieve arrays from the request
        $srnos = $request->input('srno');
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
        foreach ($srnos as $key => $srno) {
            $sagiEntry = new Sagientry();
            $sagiEntry->sagi_id = $id;
            $sagiEntry->sr_no = $srno;
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
        return redirect("Misc/Sagi/show/".$id);


    }
    

    public function sagi_show($id){
        $Sagi = sagi::with(['sagientry' => function ($query) use ($id) {
            $query->where('sagi_id', $id);
        }])->find($id);

        $Party_name = $Sagi->party_name;

        return view('Misc.Sagi.show_sagi',compact('Party_name','Sagi'));

        
    }
}
