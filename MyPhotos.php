<html>
<body>
<h1>MyPhotos</h1>
<!-- Input form -->
<form action="<?PHP echo $_SERVER['MyPhotos.php'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>ADDRESS</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="ADDRESS" maxlength="90" size="60" />
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>


<?php
require_once 'vendor/autoload.php';


use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connectionString ="DefaultEndpointsProtocol=https;AccountName=peachess;AccountKey=uG9PwV9CDNsqLhZal2NQS5FaFy+tj3Yl8NIRVtTdwwOMmTo4+VtkDciAn9EsyNKgjhoUS+qzc2jRRqrYmx8k0Q==";

$blobClient = BlobRestProxy::createBlobService($connectionString);
$fileToUpload = "/var/www/html/index.php";

if (!isset($_GET["Cleanup"])) {
  


      $containerName = "myphotos";

    try {
        
        $myfile = fopen($fileToUpload, "w") or die("Unable to open file!");
        fclose($myfile);
        
 
        echo "Uploading BlockBlob: ".PHP_EOL;
        echo $fileToUpload;
        echo "<br/>";
        
        $content = fopen($fileToUpload, "r");

 
        $blobClient->createBlockBlob($containerName, $fileToUpload, $content);


        $listBlobsOptions = new ListBlobsOptions();
        $listBlobsOptions->setPrefix("index");

        echo "These are the blobs present in the container: ";
        do{
            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
            foreach ($result->getBlobs() as $blob)
            {
                echo $blob->getName().": ".$blob->getUrl()."<br/>";
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

