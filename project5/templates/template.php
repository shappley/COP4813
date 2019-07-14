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
if (file_exists($page_content)) {
    require_once($page_content);
} else {
    echo $page_content;
}
?>
</body>
</html>