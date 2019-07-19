<h2>myMovies Express!</h2>
<form action="./logon.php" onsubmit="return project5.validateCreateAccountForm();" method="post">
    <p><strong>Create your account</strong></p>
    <input type="hidden" name="action" value="create">
    <div>
        <label for="displayName">Display Name: </label>
        <input type="text" id="displayName" name="displayName" required>
    </div>
    <div>
        <label for="emailAddress">Email Address: </label>
        <input type="text" id="emailAddress" name="emailAddress" required>
    </div>
    <div>
        <label for="confirmEmail">Confirm Email: </label>
        <input type="text" id="confirmEmail" name="confirmEmail" required>
    </div>
    <div>
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirmPassword">Confirm Password: </label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
    </div>
    <div>
        <button type="button" onclick="return project5.confirmCancel();">Cancel</button>
        <button type="reset">Clear</button>
        <button type="submit">Create Account</button>
    </div>
</form>