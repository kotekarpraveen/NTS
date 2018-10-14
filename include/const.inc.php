<?php
/*********************************************************
 Author: 		Praveen Y Kotekar
 Copyright: 	NTS-Code Assignment
 Date:		    12-10-2018
 FileName: 	    const.inc.php
 Description:	constant definition file
 **********************************************************/


require_once("errorcodes.php");

    
//Temporary storage
define('LOCAL_TEMP_FOLDER','/var/www/html/nts_assignment/temp');

//CHAR TYPES
define('CHAR_TYPE_NUMERIC','CHAR_TYPE_NUMERIC');
define('CHAR_TYPE_ALPHABETS','CHAR_TYPE_ALPHABETS');
define('CHAR_TYPE_ALPHANUMERIC','CHAR_TYPE_ALPHANUMERIC');


//S3 Bucket
define('NTS_BUCKET_NAME','ntsfolder');

//SQS
define('NTS_SQS_URL','https://sqs.us-west-2.amazonaws.com/610988408801/nts_s3_sqs');



//AWS credtionals
define('NTS_ORIGIN_AWS_SDK_KEY','AKIAIFWQVDQVQBKYSVIA');
define('NTS_ORIGIN_AWS_SDK_SECRET','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');
define('NTS_ORIGIN_AWS_S3_REGION','us-west-2');


?>
