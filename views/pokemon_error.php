<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: error.php
 * Description: The error page that displays when a requested controller is not found.
 * The variable $message can be used across the webpage to display a fitting error
 * message.
 */

class PokemonError extends View {
    public function display($message) {
        //display page header
        parent::displayHeader("Error");
?>

<div class="pokeContainer">
    <div class="pokeForm missing">
<h2>ERROR</h2>
        <img src="https://64.media.tumblr.com/cac970232b25ac8b9db96118f4c7372c/tumblr_ncsfwmvcud1sqbbw2o1_400.gif" alt="">
<p><?= $message ?></p>
        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
        <div style="height: 20px"></div>
    </div>
</div>

<?php
//display footer
    parent::displayFooter();
    }
}
