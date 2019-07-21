<table>
    <tbody>
    <?php
    foreach ($movies as $movie):
        $omdb = getMovieData($movie);
        if ($omdb !== null): ?>
            <tr>
                <td><img src="<?= $omdb['Poster'] ?>"></td>
                <td><?= $omdb["Title"] ?>(<?= $omdb["Year"] ?>)</td>
                <?php if (!$forEmail): ?>
                    <td>
                        <a href="javascript:void(0);" onclick="project5.displayMovieInformation('<?= $omdb["ID"] ?>');">
                            View More Info
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0);"
                           onclick="project5.confirmRemove('<?= $omdb["Title"] ?>','<?= $omdb["ID"] ?>');">
                            &cross;
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>