<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../css/site.css">
    <script src="script.js"></script>
</head>
<body>
<?php
if (file_exists($content)) {
    require_once($content);
} else {
    echo $content;
}
?>
</body>
</html>