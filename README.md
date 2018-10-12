# NTS - Problem Statement !

#Problem Statement -
A Tool to upload a media file 
The media file should be sent to S3 bucket
Use SQS service to record this every successful upload + S3 sync
 
### Requirements
* Linux
* PHP 5.4 and up
* PHP AWS SDK 3.0+ version.


## Usage

```php
* Import given folder in apache/httpd server (inside /var/www/html/)

## Folder Structure
* api - This folder consists of fileupload API. Its uploads file to AWS S3 bucket
* include - This folder consists of constant file. Here all project realted constant will be declared.
* utilites - This folder consists of utilities functions for file upload API.

* UI - This folder consists of index UI, where media files will be uploaded.


## How to run project 

	## Option 1
		* Project already deployed in AWS server, so it can be run by using below url - http://54.202.215.173/NTS/ui/

	## Option 2
		* You can run by project from apace server from local host.
```
## AWS related 

* S3 bucket name - ntsfolder
* All media uploaded will be stored in above bucket.
* Same will notified in SQS console.	