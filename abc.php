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
     

$connectionString = "DefaultEndpointsProtocol=https;AccountName=peachess;AccountKey=+kjiSEMPHEBqJPiQJKLhKXNt1CslN8qMz38Q+KgLB8/vkjhYU0cYFqFY5kXykYtoyxM4MSJjqFbyE4bqEvF3Bg==";
$blobClient = BlobRestProxy::createBlobService($connectionString);
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$containerName = "gallery";
$blobList = $blobClient->listBlobs($containerName, $listBlobsOptions);

echo "<br/>";
echo "Apple";
if (!isset($_GET["Cleanup"])) 
{

echo $containerName; 

try  
{

echo "Banana";



echo "Cherry";

$i = 1;
foreach($blobList->getBlobs() as $blob) 
{
$name = $blob->getName();

$url = $blob->getUrl();

$arr[$i] = $url;
$i = $i+1;

}
$len = count($arr);
echo $len;

}

catch(ServiceException $e){
  
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br/>";
}
}
?>

<p> ello </p>
<img src="<?php echo $arr[1];?>" width="500" height="600" >
<p> Bello </p>
<img src="<?php echo $arr[2];?>" width="500" height="600" >
<p> Tello </p>
<img src="<?php echo $arr[3];?>" width="500" height="600" >
</Body>
</html>
