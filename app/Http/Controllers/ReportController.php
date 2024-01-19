<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class ReportController extends Controller
{

    public $reports = [
        "EM"=> "Employee Report",
        "DE"=> "Deposit Report",
        "WI"=> "Withdraw Report",
    ];

    public function params($type)
    {
        if (array_key_exists($type, $this->reports)) {
            $viewKey = str_replace(' ', '_', $type);

            // If the provided $type is valid, load the corresponding Blade view
            return view("reports.params.$viewKey");
        }
    
        // Handle invalid $type, for example, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid report type');
    }
    

    public function index()
    {
        return view('reports.index', ['reports' => $this->reports]);
    }

    public function generateReport()
    {
    
        $emp = Employee::all();
       
        return view('reports.template', ['emp' => $emp]);

    }
    
}
