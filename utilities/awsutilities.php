<?php

/*********************************************************
 Author:      Praveen Y Kotekar
 Date:        12-10-2018
 FileName:    awsutilities.php
 Description: Routine for AWS utitlites functions.
 **********************************************************/

error_reporting(E_ALL);

require_once("vendor/autoload.php");
use Aws\Common\Aws;
use Aws\S3\S3Client;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

function uploadFilePOST($data)
{
    //Now we need to figure out image mime type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo,$data['filename']['tmp_name']);
        finfo_close($finfo);
        
        $filename = $data['filename']['name'];
    

    //Initialising the S3 related data    
        $s3data = array();
        $s3data['filename'] = $filename;
        $s3data['bucketname'] = NTS_BUCKET_NAME;
        $s3data['source'] = $data['filename']['tmp_name'];
        $s3data['mimetype'] = $mimetype;


        //Calling 
        if(!addFiletoS3($s3data))
        {
            return  array("error"=>"Failed to upload to s3 bucket");
        }
        
        return  array("success"=>"File uploaded successfully");
 }


function getS3clientObject(){
    
    $credentials = array();
    $credentialsdata = array();
    
    $credentialsdata['key'] = NTS_ORIGIN_AWS_SDK_KEY;
    $credentialsdata['secret'] = NTS_ORIGIN_AWS_SDK_SECRET;
    
    $credentials['version'] = "latest";
    $credentials['region'] = NTS_ORIGIN_AWS_S3_REGION;
    $credentials['credentials'] = $credentialsdata;
    
    $client = S3Client::factory($credentials);
    
    return $client;
}

function addFiletoS3($data)
{

    //Calling S3 client object.
    $client = getS3clientObject();
    
    try
    {
        if($result = $client->putObject(
                array('Bucket' => $data['bucketname'],
                      'Key' => $data['filename'],
                      'SourceFile' => $data['source'],
                      'ContentType' => $data['mimetype'])))
        {
            error_log(json_encode($result));
            return true;
        }
        
    }
    catch(Exception $e)
    {
        error_log("SOME ERROR OCCURED IN ADDING FILE TO S3 Filename===".$filename."Bucket===".$bucket."Source===".$source."ContentType===".$mimetype,1);
        
        error_log("Error: " . $e->getMessage()." File: " . $e->getFile()." Line: " . $e->getLine(),1);
        return false;
    }
}

function getSQSQueueMessages($sqsurl)
{
    $credentials = array();
    $credentialsdata = array();
    $credentialsdata['key'] = NTS_ORIGIN_AWS_SDK_KEY;
    $credentialsdata['secret'] = NTS_ORIGIN_AWS_SDK_SECRET;
    $credentials['version'] = "latest";
    $credentials['region'] = NTS_ORIGIN_AWS_S3_REGION;
    $credentials['credentials'] = $credentialsdata;
    
    $client = SQSClient::factory($credentials);
    
    try {
        $queuedata =array();
        $result = $client->listQueues();
        foreach ($result->get($sqsurl) as $queueUrl) {
            $queuedata[] = $queueUrl;
        }
        error_log("Queue url ==>".json_encode($queuedata));
        return $queuedata;
    } catch (AwsException $e) {
        // output error message if fails
        error_log($e->getMessage());
    }
}

?>