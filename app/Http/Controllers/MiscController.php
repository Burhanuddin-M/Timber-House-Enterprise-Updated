<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('Misc.Sagi.create_sagi',compact('Party_name'));

        dd($Party_name);
    }
}
