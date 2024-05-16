<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<?php
    include_once 'test_php_doc.php';
    // Your code here
    $htd = new HTML_TO_DOC();


    $htmlContent = ' 
    <h1>Hello World!</h1> 
    <p>This document is created from HTML.</p>';
    
    $htd->createDoc($htmlContent, "my-document.doc");
?>
    
</body>
</html>