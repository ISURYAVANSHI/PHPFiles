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
     

$connectionString = "DefaultEndpointsProtocol=https;AccountName=peachess;AccountKey=aiEPPqxZgdkCSvPQDq8CH8ZCjr2wAIaEX+5pPycqpJRSSKx16JM45DZIcsHp6UhV9zFTN9hVVb7EdS603hTp2Q==";

$blobClient = BlobRestProxy::createBlobService($connectionString);
$fileToUpload = "/var/www/html/HelloWorld.txt";

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
        $listBlobsOptions->setPrefix("");

        echo "These are the blobs present in the container: ";
        do{
            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
            foreach ($result->getBlobs() as $blob)
            {
                echo $blob->getName().": ".$blob->getUrl()."<br/>";
                 echo "Displaying the blob contents.\n";
              $url = $blob->getUrl();
              
             $blob1 = $blobClient->getBlob($containerName,$url);
                 fpassthru($blob1->getContentStream());
                 fclose($blob1->getContentStream());
    
              echo "\n";
               echo "<br/>";
            }
        
            $listBlobsOptions->setContinuationToken($result->getContinuationToken());
        } while($result->getContinuationToken());
        echo "<br/>";

     
        echo "This is the content of the blob uploaded: ";
        $blob = $blobClient->getBlob($containerName, $fileToUpload);
          fpassthru($blob->getContentStream());
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

