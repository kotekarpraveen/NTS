<?php

/*********************************************************
 Author: 	  Praveen Y Kotekar
 Date:		  12-10-2018
 FileName: 	  helpers.php
 Description:	generic utilities functions
 **********************************************************/
error_reporting(E_ALL);

//Fail with error json
function HTTPFail($message)
{
    hlog_errorlog($message);
    print json_encode(array('error'=>$message));
    exit(0);
}

//Fail with HTTP Code
function HTTPFailWithCode($code,$message)
{
    header(reasonForCode($code));
    exit($message);
}


function HTTPRedirect($location)
{
    print json_encode(array('redirect'=>$location));
    exit(0);
}

//HTTP reason codes
function reasonForCode($code)
{
    switch ($code)
    {
        case 100: $text = 'Continue'; break;
        case 101: $text = 'Switching Protocols'; break;
        case 200: $text = 'OK'; break;
        case 201: $text = 'Created'; break;
        case 202: $text = 'Accepted'; break;
        case 203: $text = 'Non-Authoritative Information'; break;
        case 204: $text = 'No Content'; break;
        case 205: $text = 'Reset Content'; break;
        case 206: $text = 'Partial Content'; break;
        case 300: $text = 'Multiple Choices'; break;
        case 301: $text = 'Moved Permanently'; break;
        case 302: $text = 'Moved Temporarily'; break;
        case 303: $text = 'See Other'; break;
        case 304: $text = 'Not Modified'; break;
        case 305: $text = 'Use Proxy'; break;
        case 400: $text = 'Bad Request'; break;
        case 401: $text = 'Unauthorized'; break;
        case 402: $text = 'Payment Required'; break;
        case 403: $text = 'Forbidden'; break;
        case 404: $text = 'Not Found'; break;
        case 405: $text = 'Method Not Allowed'; break;
        case 406: $text = 'Not Acceptable'; break;
        case 407: $text = 'Proxy Authentication Required'; break;
        case 408: $text = 'Request Time-out'; break;
        case 409: $text = 'Conflict'; break;
        case 410: $text = 'Gone'; break;
        case 411: $text = 'Length Required'; break;
        case 412: $text = 'Precondition Failed'; break;
        case 413: $text = 'Request Entity Too Large'; break;
        case 414: $text = 'Request-URI Too Large'; break;
        case 415: $text = 'Unsupported Media Type'; break;
        case 500: $text = 'Internal Server Error'; break;
        case 501: $text = 'Not Implemented'; break;
        case 502: $text = 'Bad Gateway'; break;
        case 503: $text = 'Service Unavailable'; break;
        case 504: $text = 'Gateway Time-out'; break;
        case 505: $text = 'HTTP Version not supported'; break;
        default: $text = 'Unknown Error';break;
    }
    
    return 'HTTP/1.1'.' '.$code.' '.$text;
}

function createRandomString($length=8,$type,$prefix=NULL)
{
    $characters = '';
    
    switch($type)
    {
        case CHAR_TYPE_NUMERIC:
            $characters = '0123456789';
            break;
            
        case CHAR_TYPE_ALPHABETS:
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
            
        case CHAR_TYPE_ALPHANUMERIC:
        default:
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
    }
    
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++)
    {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    if(!empty($prefix))
    {
        return $prefix.$randomString;
    }
    
    return $randomString;
}
?>