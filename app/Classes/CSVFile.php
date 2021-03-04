<?php

namespace App\Classes;
use Illuminate\Http\Request;
use App\Contracts\IConvert;

class CSVFile implements IConvert {

    public $request;
    public $array;
    
    public function __construct(Request $request) {
       $this->request = $request;
    }

    public function convertData() {
        $path = $this->request->file('file_csv')->getRealPath();
        $initialData = array_map('str_getcsv', file($path));
        $data = array_slice($initialData, 1);
        $array = [];
        foreach ($data as $key => $row) {
            $array[$key]['name'] = $row[0];
            $array[$key]['address']['line1'] = $row[1];
            $array[$key]['address']['line2'] = $row[2];
        }
        return $this->array = $array;
    }

    public function output() {
        // Save data to output
        $output = json_encode($this->array, JSON_PRETTY_PRINT);
        return session(['output' => $output]);
    }
}