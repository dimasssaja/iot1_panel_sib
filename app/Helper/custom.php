
<?php

if (!function_exists('addResponseJson')) {
    function addResponseData($parameter, $message, $success)
    {
       return [
            'message' => $message,
            'success' => $success,
            'data' => $parameter,
            'current_time' => date('H:i:s'),
            'current_date' =>  date('y-m-d'),
            'current_day'=> date('w')
        ];
    }
}

if (!function_exists('getResponseJson')) {
    function getResponseData($parameter, $message, $success)
    {
       return [
            'message' => $message,
            'success' => $success,
            'data' => $parameter,
            'current_time' => date('H:i:s'),
            'current_date' =>  date('Y-m-d'),
            'current_day'=> date('w')
        ];
    }
}

if (!function_exists('updateResponseJson')) {
    function updateResponseData($parameter, $message, $success)
    {
       return [
            'message' => $message,
            'success' => $success,
            'data' => $parameter,
            'current_time' => date('H:i:s'),
            'current_date' =>  date('y-m-d'),
            'current_day'=> date('w')
        ];
    }
}

if (!function_exists('deleteResponseJson')) {
    function deleteResponseData($message, $success)
    {
       return [
            'message' => $message,
            'success' => $success,
            'data' => null,
            'current_time' => date('H:i:s'),
            'current_date' =>  date('y-m-d'),
            'current_day'=> date('w')
        ];
    }
}
