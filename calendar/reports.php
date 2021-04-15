<?php
// We'll be outputting a PDF
header('Content-type: text/csv');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="GeneratedReport.csv"');

// The PDF source is in original.pdf
readfile('statsFile.csv');
?> 