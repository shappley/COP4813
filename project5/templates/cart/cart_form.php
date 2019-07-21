<?php if (!$forEmail): ?>
    <div>
        <label>
            Welcome, <?php echo $_SESSION["username"] ?>
            <a href="#" onclick="return project5.confirmLogout();">(logout)</a>
        </label>
    </div>
<?php endif; ?>
    <div>
        <h2>myMovies Xpress!</h2>
        <p>
            <?= $count === 0
                ? "Add Some Movies to Your Cart"
                : "{$count} Movies in Your Shopping Cart";
            ?>
        </p>
        <div>
            <label for="select_order">Sort</label>
            <select id='select_order' onchange='project5.changeMovieDisplay();'>
                <option value="0">Movie Title</option>
                <option value="1">Runtime (shortest -> longest)</option>
                <option value="2">Runtime (shortest -> longest)</option>
                <option value="3">Year (old -> new)</option>
                <option value="4">Year (new -> old)</option>
            </select>
        </div>
        <div id='shopping_cart'>
            <?= $movieList ?>
        </div>
        <?php if (!$forEmail): ?>
            <button type="button" onclick="location.replace('./search.php')">Add Movie</button>
            <button type="button" onclick="project5.confirmCheckout();">Checkout</button>
        <?php endif; ?>
    </div>
<?php if (!$forEmail): ?>
    <div id='modalWindow' class='modal'>
        <div id='modalWindowContent' class='modal-content'>
        </div>
    </div>
<?php endif; ?>