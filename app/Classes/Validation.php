<?php

namespace App\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Validation {

    public static function validateInput(Request $request, string $allowType) {
        $messages = ['file_'.$allowType.'.required' => 'The input '.$allowType.' file  is required'];
        $rules = ['file_'.$allowType => 'required'];
        $validator = Validator::make($request->all() , $rules, $messages);
        if ($validator->fails())
        {
            return $validator;
        }
        $extension = $request->file('file_'.$allowType)->getClientOriginalExtension();
        $validator->after(function ($validator) use ($extension, $allowType)
        {
            if (self::checkExtension($extension, $allowType) == false)
            {
                $validator->errors()->add('file_'.$allowType, 'The type of file must be ' . $allowType);
            }
        });
        if ($validator->fails())
        {
            return $validator;
        }
    }

    public static function checkExtension(string $fileExt, string $allowType) {
        $valid = [$allowType];
        return in_array($fileExt, $valid) ? true : false;
    } 
}