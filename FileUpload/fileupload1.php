<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>
<div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='fileupl.html';">Main Page</button>
</div>

<div align="center">
<form action="" method="post" enctype="multipart/form-data">
   <br>
    <b>Select image : </b> 
    <input type="file" name="file" id="file" style="border: solid;">
    <input type="submit" value="Submit" name="submit">
</form>
</div>
<?php

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $target_dir = "uploads/";

    $file_name = basename($_FILES["file"]["name"]);
    $file_name = preg_replace("/[^a-zA-Z0-9.-]/", "_", $file_name); // Solo permite letras, números, puntos y guiones

    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</body>
</html>
