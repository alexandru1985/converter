<?php

namespace App\Classes;
use Illuminate\Http\Request;
use App\Contracts\IConvert;

class JSONFile implements IConvert {

    public $request;
    public $storagePath;
    
    public function __construct(Request $request) {
       $this->request = $request;
       $this->storagePath();
    }
    public function storagePath() {
        return $this->storagePath = storage_path() . '/files/';
    }
    public function convertData() {
        // Save json file on disk
        $file = $this->request->file('file_json');
        $fileName = $file->getClientOriginalName();
        $file->move($this->storagePath, $fileName);

        // Put json data to array
        $filePath = $this->storagePath.$fileName;
        if(file_exists($filePath)) {
            $jsonString = file_get_contents($filePath);
            $data = json_decode($jsonString, true);

            // Save array data in csv format
            $list = [
                ['name', 'address_line1', 'address_line2'],
            ];
            foreach($data as $key => $row) {
                    $list[$key+1][] = $row['name'];
                    $list[$key+1][] = $row['address']['line1'];
                    $list[$key+1][] = $row['address']['line2'];
            }
            $fp = fopen($this->storagePath.'data.csv', 'w');
            foreach ($list as $fields) {
                fputcsv($fp, $fields);
            }
            fclose($fp);
        }
    }

    public function output() {
        // Save data to output
        $output = file_get_contents($this->storagePath.'data.csv');
        return session(['output' => $output]);
    }
}