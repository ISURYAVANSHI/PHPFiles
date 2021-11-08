<html>
<body>
<h1>MyGallery</h1>

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
$fileToUpload = "/var/www/html/MyGallery.html";

if (!isset($_GET["Cleanup"])) {
  


      $containerName = "gallery";

    try {
        
        $myfile = fopen($fileToUpload, "w") or die("Unable to open file!");
        fclose($myfile);
        
 
        echo "Uploading BlockBlob: ".PHP_EOL;
        echo $fileToUpload;
        echo "<br/>";
        
        $content = fopen($fileToUpload, "r");

 
        $blobClient->createBlockBlob($containerName, $fileToUpload, $content);


        $listBlobsOptions = new ListBlobsOptions();
        $listBlobsOptions->setPrefix("sad");

        echo "These are the blobs present in the container: ";
        do{
            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
            foreach ($result->getBlobs() as $blob)
            {
                echo $blob->getName().": ".$blob->getUrl()."<br/>";
                 echo "Displaying the blob contents.\n";
               $url = $blob->getUrl();
              
                           
                  $blob3 = $blobClient3->getBlob($containerName,'sad.jpeg'); 
                 fpassthru($blob3->getContentStream());
                 fclose($blob3->getContentStream());
                 
                 $blob1 = $blobClient1->getBlob($containerName,$url); 
                 fpassthru($blob1->getContentStream());
                 fclose($blob1->getContentStream());

    
              echo "\n";
               echo "<br/>";
            }
        
            $listBlobsOptions->setContinuationToken($result->getContinuationToken());
        } while($result->getContinuationToken());
        echo "<br/>";

     
        echo "This is the content of the blob uploaded: ";
        $blob2 = $blobClient2->getBlob($containerName, $fileToUpload);
          fpassthru($blob2->getContentStream());
        echo "<br/>";
    }
    catch(ServiceException $e){
  
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br/>";
    }
    catch(InvalidArgumentTypeException $e){

        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br/>";
    }
    catch(InvalidArgumentTypeException $e){

        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br/>";
    }
} 
?>
</body>
</html>

