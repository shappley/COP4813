<div class='modal-header'>
    <span class='close'>[Close]</span>
    <h2>
        <?= $movie["Title"] ?> (<?= $movie["Year"] ?>)
        <?= $movie["Rated"] ?>
        <?= $movie["Rating"] ?>
        <?= $movie["Runtime"] ?>
        <br/>
        <?= $movie["Genre"] ?>
    </h2>
</div>
<div class='modal-body'>
    <p>
        Actors: <?= $movie["Actors"] ?>
        <br/>
        Directed By: <?= $movie["Director"] ?>
        <br/>
        Written By: <?= $movie["Writer"] ?>
    </p>
</div>
<div class='modal-footer'>
    <p><?= $movie === null ? "Invalid Movie ID!" : $movie["Plot"] ?></p>
</div>