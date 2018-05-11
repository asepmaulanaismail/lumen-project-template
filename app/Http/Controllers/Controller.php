<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // for custom validation messages
    protected $validatorMessages = [
        'required' => 'The :attribute field is required.',
        'same'    => 'The :attribute and :other must match.',
        'size'    => 'The :attribute must be exactly :size.',
        'between' => 'The :attribute must be between :min - :max.',
        'in'      => 'The :attribute must be one of the following types: :values',
    ];

    protected function generateMessageString($errors, $delimiter = "\n"){
        $errorMsg = "";
        foreach ($errors->all() as $message) {
            $errorMsg .= $message.$delimiter;
        }
        return $errorMsg;
    }

    protected function generateMessageArray($errors){
        $errorMsg = [];
        foreach ($errors->all() as $message) {
            array_push($errorMsg, $message);
        }
        return $errorMsg;
    }
}
