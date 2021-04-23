<?php

//check to see that the variable came through
//the variable is associated with the file of the option the user presses on the admin page
if(isset($_GET['stat'])){
    $filename = $_GET['stat'];
}
//downloads csv file to computer of type filename chosen
header('Content-type: application/csv');

header('Content-Disposition: attachment; filename="'.basename($filename).'"');

readfile($filename)

?> 