<?php
//We'll be outputting a PDF
header('Content-type:application/pdf');

// It will be called User Manual.pdf
header('Content-Disposition: attachment; filename="User Manual.pdf"');

// The PDF source is in User Manual.pdf
readfile('User Manual.pdf');
?> 