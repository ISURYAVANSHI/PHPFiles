<html>
<h1>Welcome to MyGallery </h1>
<Body>
<?php

require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\GetBlobResult;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Blob\Models\ListContainersOptions;
     
$connectionString = "DefaultEndpointsProtocol=https;AccountName=peachess;AccountKey=6EQiMaYP05LTuauMh8IhDQH7ccvgyOMmObEGO4XBln9ZyvkpRIU0tuodHjN/Y2GmMM5cl6IljKPGc3Aa5+xTNQ==";
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("sad");
$containerName = "gallery";

echo "Apple";
if (!isset($_GET["Cleanup"])) 
{

echo $containerName; 

try  
{

echo "Banana";
$blobClient = BlobRestProxy::createBlobService($connectionString);
$blobList = $blobClient->listBlobs($containerName, $listBlobsOptions);
echo "Cherry";
$i = 1;
foreach($blobList->getBlobs() as $blob) 
{

$url = $blob->getUrl();
echo $url;
     
$arr[$i] = $url;
$i = $i+1;

}
$len = count($arr);
echo $len;

}

catch(ServiceException $e){
  
$code = $e->getCode();
$error_message = $e->getMessage();
echo $e;
echo $code.": ".$error_message."<br/>";
}
}
?>
</Body>
</html>
