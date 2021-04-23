<?php

//check to see that the variable came through
if(isset($_GET['stat'])){
    $filename = $_GET['stat'];
}

header('Content-type: application/csv');

header('Content-Disposition: attachment; filename="'.basename($filename).'"');

readfile($filename)

?> 