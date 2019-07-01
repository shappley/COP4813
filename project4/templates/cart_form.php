<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/site.css">
    <script src="./script.js"></script>
</head>
<body>
<div>
    <label>
        Welcome, <?php echo $_SESSION["username"] ?>
        <a href="#" onclick="return project4.confirmLogout();">(logout)</a>
    </label>
    <h2>myMovies Xpress!</h2>
    <label><?php echo count($movies); ?> movies in your shopping cart</label>
</div>
<div>
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
                        <a href="#" onclick="return project4.confirmRemove('<?php echo $omdb["Title"]; ?>');">
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
