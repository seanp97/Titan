<?php 
    require_once './views/header.php';
    require_once './titan.php';
    Titan::Title("Home Page");
?>

<h1>Home Page</h1>

<form action="./controllers/upload.php" method="POST" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" />
  <input type="submit" value="Upload Image" name="submit" />
</form>


<?php 
    require_once './views/footer.php';
?>
