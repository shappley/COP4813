<h2>myMovies Express!</h2>
<form action="./logon.php" method="post">
    <p>Enter your username. A recovery link will be sent to your registered email.</p>
    <input type="hidden" name="action" value="forgot">
    <div>
        <label style="min-width: 0;" for="username">Username: </label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <button type="button" onclick="return project5.confirmCancel();">Cancel</button>
        <button type="reset">Clear</button>
        <button type="submit">Submit</button>
    </div>
</form>