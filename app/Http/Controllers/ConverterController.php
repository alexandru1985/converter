<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Convert;
use App\Classes\Validation;

class ConverterController extends Controller
{

    public function index() {
        return view('converter');
    }

    public function toJSON(Request $request) {
        $validation = Validation::validateInput($request, 'csv');
        if ($validation)
        {
            return redirect()->back()->withErrors($validation->errors());
        }
        $convert = new Convert($request, 'csv');
        $convert->convertData();
        $convert->output();
        return redirect('/');
    }

    public function toCSV(Request $request) {
        $validation = Validation::validateInput($request, 'json');
        if ($validation)
        {
            return redirect()->back()->withErrors($validation->errors());
        }
        $convert = new Convert($request, 'json');
        $convert->convertData();
        $convert->output();
        return redirect('/'); 
    }
}
