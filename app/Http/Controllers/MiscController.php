<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sagientry;
use App\Models\Sagi;
use App\Models\bark;
use App\Models\barkentry;

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


    public function bark_index(){
        return view('Misc.Bark.index');
    }

    public function bark_add(){

        $Bark = bark::all();
        return view('Misc.Bark.addEmployee',compact('Bark'));
    }

    public function bark_post(Request $request){

        $Bark = New bark();

        $Bark->name = $request->name;
        $Bark->short_rate = $request->long;
        $Bark->long_rate = $request->short;

        $Bark->save();
    return redirect('Misc/Bark/add')->with('success','Employee is added successfully');
    }

    public function bark_edit(Request $request,$id){
        $Bark = bark::find($id);

        $Bark->name = $request->name;
        $Bark->short_rate = $request->long;
        $Bark->long_rate = $request->short;

        $Bark->save();
    return redirect('Misc/Bark/add')->with('success','Employee is updated successfully');
    }


    public function bark_entry(){

        $Barks = bark::all();
        $BarksEntry = barkentry::all();
          return view("Misc.Bark.barkentry",compact('Barks','BarksEntry'));
    }

    public function bark_entry_post(Request $request){
 
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

        if($exists){
            return redirect('Misc/Bark/entry')->with('fail','Entry is Already Done');
        }
    
        $Bark = Bark::find($id);
        
        if($type === "long"){
            $rate = $Bark->long_rate;
            $total = $quantity * $rate; // Corrected calculation for total
        } elseif($type === "short"){
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
    
        return redirect('Misc/Bark/entry')->with('success','Entry is Successfully Done');
    }


    public function bark_report(){
        return view('Misc.Bark.report');
    }
    
}
