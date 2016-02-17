<?php

    $db = new SQlite3 ("pdf");
    $key = $_GET["key"];
    $file = "downloadFile.pdf";
    //echo("my key = ".$key);
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
?>