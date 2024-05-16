<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<?php
    include './test_php_doc.php';

    $htd = new HTML_TO_DOC();

    $title = $_POST['title'];
    $description = $_POST['description'];

    $htd->createDoc($description, $title.".doc", true);
    
    header('Redirect /');
?>
    
</body>
</html>