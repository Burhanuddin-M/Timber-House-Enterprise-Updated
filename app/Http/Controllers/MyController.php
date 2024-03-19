<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\platerecords;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\credentials;
use App\Models\permission;

class MyController extends Controller
{

    //Get Login
    public function getLogin()
    {
        return view('login');
    }

    //Post Login
    public function postLogin(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6', // Adjust the validation rules as needed
        ]);

        $password = $request->input('password');
        $user = credentials::where('password', $password)->first(); // Replace YourUserModel with your actual User model

        if ($user) {
            // Authentication passed
            $request->session()->put('username', $user->name);
            $request->session()->put('user_id', $user->id);
            return redirect()->intended('/dashboard'); // Redirect to the intended URL or a default one
        } else {
            // Authentication failed
            throw ValidationException::withMessages([
                'password' => ['Invalid credentials'], // Display a custom error message
            ]);
        }
    }


    //Get Login to Superadmin
    public function admin_login()
    {
        return view('SuperAdmin.login');
    }

    //Post login to superadmin
    public function admin_post(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6', // Adjust the validation rules as needed
        ]);

        $password = $request->input('password');


        if ($password == "786515253") {
            // Authentication passed
            return redirect()->intended('/Superadmin/index'); // Redirect to the intended URL or a default one
        } else {
            // Authentication failed
            throw ValidationException::withMessages([
                'password' => ['Invalid credentials'], // Display a custom error message
            ]);
        }
    }

    public function admin_index()
    {
        $credentialsWithPermissions = credentials::with('permission')->get();

        return view('SuperAdmin.index', compact('credentialsWithPermissions'));
    }

    public function admin_add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'permissions' => 'array', // You might want to adjust this based on your requirements
        ]);

        $My_permissions = $request->input('permissions', []); // Retrieve the array of permissions

        $Credentials = new credentials();
        $Credentials->name = $request->input('name');
        $Credentials->password = $request->input('password');
        $Credentials->save();


        $Permissions = new permission();
        $Permissions->credential_id = $Credentials->id;
        $Credentials->mobile = $request->input('mobile');
        $Permissions->permissions = json_encode($My_permissions);
        $Permissions->save();

        return redirect('/Superadmin/index')->with('successadd', 'Created password successfully');
    }

    public function admin_update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'permissions' => 'array', // You might want to adjust this based on your requirements
        ]);

        $My_permissions = $request->input('permissions', []); // Retrieve the array of permissions

        $Credentials = credentials::find($request->id);
        $Credentials->name = $request->input('name');
        $Credentials->password = $request->input('password');
        $Credentials->mobile = $request->input('mobile');
        $Credentials->save();

        // Check if a permission record exists for the credential
        $Permissions = permission::where('credential_id', $Credentials->id)->first();



        $Permissions->permissions = json_encode($My_permissions);
        $Permissions->save();


        return redirect('/Superadmin/index')->with('success', 'Updated successfully');
    }

    public function admin_delete($id)
    {
        $credential = Credentials::findOrFail($id);
        $credential->delete();

        return redirect('/Superadmin/index')->with('successdelete', 'Credential deleted successfully');
    }




    //Dashboard Page
    public function dashboard(Request $request)
    {
        $credential = credentials::with(['permission'])->findOrFail(session('user_id'));
        return view('dashboard', [
            'credential' => $credential
        ]);
    }
    public function getForm($id)
    {
        $Plate = platerecords::find($id);
        return view('Documents.form', compact('Plate'));
    }



    public function download(Request $request, $file)
    {
        return response()->download(public_path('assets/' . $file));
    }


    //View Function for each Documents
    public function Viewinsurance($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.insurance', compact('data'));
    }

    public function Viewfitness($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.fitness', compact('data'));
    }

    public function Viewlicense($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.license', compact('data'));
    }

    public function Viewnational($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.national', compact('data'));
    }

    public function Viewpuc($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.puc', compact('data'));
    }

    public function Viewrcbook($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.rcbook', compact('data'));
    }

    public function Viewroadtax($id)
    {

        $data = platerecords::find($id);
        return view('Documents.Documents_view.roadtax', compact('data'));
    }





    public function showPlates()
    {

        //Fetching the records of Number plate..
        $Plates = platerecords::all();
        $countrecords = platerecords::count();

        return view('Documents.showplates', compact('Plates', 'countrecords'));
    }

    public function showRecords($id)
    {


        // $platesrecords =  platerecords::with('numberplate')->get();
        $platesrecords = platerecords::where('id', $id)->get();



        return view('Documents.showrecords', compact('platesrecords'));
    }

    public function addPlates(Request $request)
    {

        $platerecords = new platerecords();

        $platerecords->numberplate = $request->input('numberplate');


        // $platerecords->puc = 'Blank';
        // $platerecords->insurance = 'Blank';
        // $platerecords->rcbook = 'Blank';

        $platerecords->save();



        session()->flash('success', 'Plate added successfully');

        // Redirect to a success page or return a response as needed
        return redirect('/documents/showplates')->with('success', 'Plate added successfully');
    }
}
