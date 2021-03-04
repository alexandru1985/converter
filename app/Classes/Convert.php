<?php

namespace App\Classes;
use Illuminate\Http\Request;
use App\Classes\CSVFile;
use App\Classes\JSONFile;

class Convert {

    public $fileType;

    public function __construct(Request $request, string $fileType) {
        $this->fileType = $this->getConvertType($request, $fileType);
    }

    public function getConvertType(Request $request, string $fileType) {
        switch ($fileType) {
            case "csv":
              return new CSVFile($request);
              break;
            case "json":
              return new JSONFile($request);
              break;
          }
    }
    
    public function convertData() {
        return $this->fileType->convertData();
    }
    public function output() {
        return $this->fileType->output();
    }

}