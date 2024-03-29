<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/site.css">
    <script src="./script.js"></script>
</head>
<body>
<?php require_once("./templates/welcome_banner.php") ?>
<div>
    <label><?php echo count($movies); ?> movies in your shopping cart</label>
    <?php if (count($movies) === 0): ?>
        <label>Add Some Movies to Your Cart</label>
    <?php else: ?>
        <table class="bordered">
            <tbody>
            <?php foreach ($movies as $movie): $omdb = getOmdbDataById($movie); ?>
                <tr>
                    <td><img class="poster" src="<?php echo $omdb['Poster'] ?>"></td>
                    <td><?php echo $omdb['Title'] . " (" . $omdb['Year'] . ")" ?></td>
                    <td>
                        <a href="#" onclick="return project4.confirmRemove('<?= $omdb["Title"]; ?>', '<?= $omdb["imdbID"]; ?>');">
                            &cross;
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<div>
    <button onclick="location.href='./search.php'">Add Movie</button>
    <button onclick="return project4.confirmCheckout();">Checkout</button>
</div>
</body>
</html>
