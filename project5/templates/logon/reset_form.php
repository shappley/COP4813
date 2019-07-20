<h2>myMovies Express!</h2>
<form action="./logon.php" onsubmit="return project5.validateResetPasswordForm();" method="post">
    <input type="hidden" name="action" value="reset">
    <input type="hidden" name="userId" value="<?= $userId ?>">
    <div>
        <label for="password">New Password: </label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required>
    </div>
    <div>
        <button type="button" onclick="return project5.confirmCancel();">Cancel</button>
        <button type="reset">Clear</button>
        <button type="submit">Reset Password</button>
    </div>
</form>