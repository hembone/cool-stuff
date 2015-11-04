<?php
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=custom-template.html");
readfile('downloads/'.$_GET['file']);
?>
