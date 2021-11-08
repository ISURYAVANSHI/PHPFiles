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


echo "<br/>";
echo "Apple";
if (!isset($_GET["Cleanup"])) 
{
$containerName = "gallery";
echo $containerName; 

try  
{

echo "Banana";
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$blobList = $blobClient->listBlobs($containerName, $listBlobsOptions);

foreach($blobList->getBlobs() as $blob) 
{
$name = $blob->getName();
echo $blob->getName();
echo"<br/>";
$url = $blob->getUrl();
echo $blob->getUrl();
echo"<br/>";


?>

<p> $name </p>
<p> $url</p>
<img src ="https://peachess.blob.core.windows.net/gallery/sad.jpeg"/></br>

<?php

}

echo "Cherry";

}

catch(ServiceException $e){
  
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br/>";
}
}
?>
</Body>
</html>
