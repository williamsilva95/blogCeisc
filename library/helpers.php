<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

function validateErros($validate, $array_error = [])
{
    $messages_erros = array();
    $messages       = $validate->messages();

    foreach($messages as $key => $message)
    {
        $messages_erros["$key"] = $message;
    }

    foreach ($array_error as $key => $value) {
        $messages_erros["$key"] = [$value];
    }

    return $messages_erros;
}

function arrayToSelect(array $values, $key, $value, $noZeroIndex=null) {
    if(count($values) > 0)
    {
        $data = array();
        if($noZeroIndex==null)
        {
            $data[0] = 'Selecione';
        }
        foreach ($values as $row) {
            $data[$row[$key]] = $row[$value];
        }
        return $data;
    }else{
        if($noZeroIndex==null)
        {
            return ['Selecione'];
        }
        return [];
    }
}
