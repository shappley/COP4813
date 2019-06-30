<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <script src="./script.js"></script>
</head>
<body>
<div>
    <label>
        Welcome, <?php echo $_SESSION["username"] ?>
        <a href="#" onclick="return project4.confirmLogout();">(logout)</a>
    </label>
    <h2 style="margin-bottom: 0;">myMovies Xpress!</h2>
    <label><?php echo count($movies); ?> movies in your shopping cart</label>
</div>
<div>
    <?php if (count($movies) === 0): ?>
        <label>Add Some Movies to Your Cart</label>
    <?php else: ?>
        <table>
            <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?php echo $movie; ?></td>
                    <td>Hey it works</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
