<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Files</title>
</head>
<body>

    <!-- DO NOT WORk IN THIS DOCUMENT -->
    <!-- WORK IN create.php -->

    <form action="create.php" method="POST">
        <input type="text" placeholder="File title" name="title" required><br/><br/>
        <textarea name="description" id="" cols="30" rows="10" placeholder="File content" required></textarea><br/>
        <input type="submit" value="Create">
    </form>

</body>
</html>