<?php
  header('Content-Type: image/jpeg');
  // Indicates that the image file name will download as logo.jpeg
  // but user is NOT  prompted to download the file

  header('Content-Disposition: inline; filename="logo.jpeg"');
  
  header('Content-Transfer-Encoding: binary');

  $size = filesize('original.jpeg');
  header("Content-Length: $size");
  
 // Outputs the file
  readfile('original.jpeg');
  exit(0);
