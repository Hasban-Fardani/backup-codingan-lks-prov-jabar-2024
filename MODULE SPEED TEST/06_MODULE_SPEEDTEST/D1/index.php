<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouse Style</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <canvas width="800" height="800"></canvas>
    <script>
        const canvas = document.querySelector('canvas')
        const ctx = canvas.getContext('2d')

        // garis diagram
        ctx.fillRect(50, 50, 2, canvas.height - 100)
        ctx.fillRect(50, canvas.height - 50, canvas.width - 100, 2)

        // text
        ctx.font = "14pt Arial"
        ctx.fillText("500", 10, 50)
    </script>    
</body>
</html>