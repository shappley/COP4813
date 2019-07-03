<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search for a Movie</title>
    <link rel="stylesheet" href="../css/site.css">
    <script src="./script.js"></script>
</head>
<body>
<?php require_once("./templates/welcome_banner.php") ?>
<div>
    <label>Search for a movie by keyword</label>
    <form action="./search.php" method="post">
        <div>
            <input type="text" name="search" placeholder="Keyword" required>
        </div>
        <div>
            <button onclick="location.href='./index.php'" type="button">Cancel</button>
            <button type="reset">Clear</button>
            <button type="submit">Search</button>
        </div>
    </form>
</div>
<?php
if (isset($results)) {
    require_once("./templates/results_form.php");
}
?>
</body>
</html>