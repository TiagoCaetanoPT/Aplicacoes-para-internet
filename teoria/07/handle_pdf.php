<?php

  header('Content-Type: application/pdf');
  // Indicates that user should be prompted to download
  // the file and that the pre-filled filename should be
  // example.pdf

  header('Content-Disposition: attachment; filename="example.pdf"');
  
  header('Content-Transfer-Encoding: binary');

  $size = filesize('original.pdf');
  header("Content-Length: $size");
  
 // Outputs the file
  readfile('original.pdf');
  exit(0);
