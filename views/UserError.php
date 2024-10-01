<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: error.php
 * Description: The error page that displays when a requested controller is not found.
 * The variable $message can be used across the webpage to display a fitting error
 * message.
 */

$page_title = "Page not found";
//display header
View::displayHeader($page_title);

?>

<div class="pokeContainer">
    <div class="pokeForm missing">
<h2>ERROR 404 - Page not found</h2>
        <img src="https://64.media.tumblr.com/cac970232b25ac8b9db96118f4c7372c/tumblr_ncsfwmvcud1sqbbw2o1_400.gif" alt="">
<p>The page you're looking for does not exist.</p>
        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
        <div style="height: 20px"></div>
    </div>
</div>

<?php
//display footer
View::displayFooter();
