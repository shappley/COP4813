<div>
    <label>
        Welcome, <?php echo $_SESSION["username"] ?>
        <a href="#" onclick="return project5.confirmLogout();">(logout)</a>
    </label>
</div>
<div>
    <h2>myMovies Express!</h2>
    <p>Search for a movie</p>
</div>
<div>
    <form action="./search.php" method="post">
        <div>
            <label for="searchKeyword">Keyword</label>
            <input type="text" id="searchKeyword" name="keyword" required>
        </div>
        <div>
            <button type="button" onclick="location.replace('./index.php')">Cancel</button>
            <button type="reset">Clear</button>
            <button type="submit">Search</button>
        </div>
    </form>
</div>