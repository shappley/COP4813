<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Authentication</title>
    <link rel="stylesheet" href="../css/site.css">
</head>
<body>
<form action="./logon.php" method="post">
    <h2>myMovies Xpress!</h2>
    <?php if (!empty($message)): ?>
        <div>
            <label class="error"><?php echo $message; ?></label>
        </div>
    <?php endif; ?>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="reset">Clear</button>
        <button type="submit">Login</button>
    </div>
</form>
<footer>
    <a href="../index.html">ePortfolio</a>
</footer>
</body>
</html>