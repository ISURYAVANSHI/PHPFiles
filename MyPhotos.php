<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HTML Form</title>
  </head>
  <body>
    <h1>Form</h1>
    <form method="POST" action="MyPhotos.php" enctype="multipart/form-data" >
      <label  class="form-label">Name</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="name" required > <br><br>
      <input type="file" name="file"><br><br>
      
      <input type="submit" value="submit"  name="submit">
    </form>
  </body>
</html>
