<?php
/*********************************************************
 Author: 	  Praveen Y Kotekar
 Date:		  12-10-2018
 FileName: 	  fileupload.php
 Description: Routine for uploading files
 **********************************************************/
header("Content-Type:application/json");
error_reporting(E_ALL);

require_once('../include/const.inc.php');
require_once('../utilities/helpers.php');
require_once('../utilities/awsutilities.php');


//First check what is the method
if(!isset($_SERVER['REQUEST_METHOD']) || !isset($_SERVER['REQUEST_URI']))
{
    HTTPFailWithCode(400,'HTTP Method or request URI is not set');
}

$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

if($method != 'POST')
{
    HTTPFailWithCode(405,'Only  POST method is allowed');
}


if(!uploadFilePOST($_FILES))
{
    HTTPFail('Could not upload file');
}


//Return this image data
print json_encode(array('success'=>$_FILES['filename']['name']));

exit(0);
?>
