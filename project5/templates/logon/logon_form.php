<form action="./logon.php" method="post">
    <h2>myMovies Xpress!</h2>
    <input type="hidden" name="action" value="login">
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
        <a href="./logon.php?form=create">Create Account</a> |
        <a href="logon.php?form=forgot">Forgot Password</a>
    </div>
    <div>
        <button type="reset">Clear</button>
        <button type="submit">Login</button>
    </div>
</form>
<footer>
    <a href="../index.html">ePortfolio</a>
</footer>