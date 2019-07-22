<div>
    <label>
        Welcome, <?php echo $_SESSION["username"] ?>
        <a href="#" onclick="return project5.confirmLogout();">(logout)</a>
    </label>
</div>
<div>
    <h2>myMovies Express!</h2>
    <p><?= count($searchResults) ?> Movies Found</p>
</div>
<?php if (count($searchResults) > 0): ?>
    <div>
        <table>
            <tbody>
            <?php foreach ($searchResults as $movie): ?>
                <tr>
                    <td><img height="100" src="<?= $movie["Poster"] ?>"></td>
                    <td>
                        <a href="https://www.imdb.com/title/<?= $movie["imdbID"] ?>/">
                            <?= $movie["Title"] ?>(<?= $movie["Year"] ?>)
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="return project5.addMovie('<?= $movie["imdbID"] ?>')">&plus;</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<div>
    <button onclick="location.replace('./index.php')">Cancel</button>
</div>