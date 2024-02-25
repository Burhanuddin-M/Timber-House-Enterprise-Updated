<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendence;
use App\Models\Transaction;
use Carbon\Carbon;

class UniqueController extends Controller
{


    public function index()
    {
        return view('Attendence.index');
    }

    public function deposits()
    {
        $Employees = Employee::all();
        return view('Attendence.deposits', compact('Employees'));
    }

    public function withdraw()
    {
        $Employees = Employee::all();
        return view('Attendence.withdraw', compact('Employees'));
    }

    public function post_deposits(Request $request, $id)
    {

        $amount = $request->amount;
        $message = $request->message . " - " . $amount;


        $transaction = Transaction::create([
            'employee_id' => $id,
            'amount' => $amount,
            'type' => "DEPOSIT",
            'note' => $message,
        ]);


        $Employee = Employee::find($transaction->employee_id);
        $Employee->save();

        $Message = $Employee->name . " was deposited the amount of " . $amount;

        return redirect('/attendence/deposits')->with('success', $Message);
    }

    public function post_withdraw(Request $request, $id)
    {

        $amount = $request->amount;
        $message = $request->message . " - " . $amount;


        $transaction = Transaction::create([
            'employee_id' => $id,
            'amount' => $amount,
            'type' => "DEBIT",
            'note' => $message,
        ]);


        $Employee = Employee::find($transaction->employee_id);
        $Employee->save();

        $Message = $Employee->name . " was withdraw the amount of " . $amount;

        return redirect('/attendence/withdraw')->with('success', $Message);
    }

    public function showreport()
    {
        $Employees = Employee::all();
        return view('Attendence.report', compact('Employees'));
    }

    public function specificreport($id)
    {
        $MyEmployee = Employee::find($id);
        return view('Attendence.specificreport', compact('MyEmployee'));
    }


    public function finalreport($id, request $request)
    {
        $date = $request->date;
        $start_date = Carbon::parse($date)->startOfMonth();
        $end_date = Carbon::parse($date)->endOfMonth();
        $employeeData = Employee::find($id);

        $attendance = Attendance::where('employee_id', $id)
            ->whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->orderBy('date', 'asc')
            ->get();

        $total_overtime = $attendance->sum('extra_hours');
        $total_withdraw = Transaction::where('employee_id', $id)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('type', 'DEBIT')
            ->sum('amount');

        $total_present_full_day = $attendance->where('type', 'PRESENT')->where('is_half_day', 0)->count('type');
        $total_present_half_day = $attendance->where('type', 'PRESENT')->where('is_half_day', 1)->count('type');

        $total_present = $total_present_full_day + ($total_present_half_day / 2);

        $date_withdraw = Transaction::where('employee_id', $id)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('type', 'DEBIT')
            ->get();




        return view('Attendence.finalreport', [
            'employeeData' => $employeeData,
            'attendance' => $attendance->toArray(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_overtime' => $total_overtime,
            'total_withdraw' => $total_withdraw,
            'total_present' => $total_present,
            'date_withdraw' => $date_withdraw,
            'date'=>$date
        ]);
    }

    public function myreport($id, request $request)
    {
        $date = $request->date;
        $start_date = Carbon::parse($date)->startOfMonth();
        $end_date = Carbon::parse($date)->endOfMonth();
        $employeeData = Employee::find($id);

        $attendance = Attendance::where('employee_id', $id)
            ->whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->orderBy('date', 'asc')
            ->get();

        $total_overtime = $attendance->sum('extra_hours');
        $total_withdraw = Transaction::where('employee_id', $id)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('type', 'DEBIT')
            ->sum('amount');

        $total_present_full_day = $attendance->where('type', 'PRESENT')->where('is_half_day', 0)->count('type');
        $total_present_half_day = $attendance->where('type', 'PRESENT')->where('is_half_day', 1)->count('type');

        $total_present = $total_present_full_day + ($total_present_half_day / 2);

        $date_withdraw = Transaction::where('employee_id', $id)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('type', 'DEBIT')
            ->get();




        return view('Attendence.myreport', [
            'employeeData' => $employeeData,
            'attendance' => $attendance->toArray(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_overtime' => $total_overtime,
            'total_withdraw' => $total_withdraw,
            'total_present' => $total_present,
            'date_withdraw' => $date_withdraw,
            'date'=>$date
        ]);
    }
}
