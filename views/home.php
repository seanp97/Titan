<?php 
    require 'header.php';
    require './titan.php';
    Titan::Title("Home Page");
?>

<h1>Home Page</h1>

<?php 

    Titan::InsertInto("Persons", "FirstName, LastName, EmailAddress", "'Lily', 'Wilson', 'lilywilson@gmail.com'");


?>


<?php 
    require 'footer.php';
?>