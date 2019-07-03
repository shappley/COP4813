<div>
    <label><?= count($results); ?> Movies Found</label>
    <?php if (count($results) > 0): ?>
        <table class="bordered">
            <tbody>
            <?php foreach ($results as $movie): ?>
                <tr>
                    <td><img class="poster" src="<?php echo $movie['Poster'] ?>"></td>
                    <td>
                        <a href="https://www.imdb.com/title/<?= $movie['imdbID']; ?>" target="_blank">
                            <?php echo $movie['Title'] . " (" . $movie['Year'] . ")" ?>
                        </a>
                    </td>
                    <td>
                        <button type="button" onclick="return project4.addMovie('<?php echo $movie["imdbID"]; ?>');">
                            &plus;
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<div>
    <button type="button" onclick="location.href='./index.php'">Cancel</button>
</div>