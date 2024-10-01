<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: error.php
 * Description: The error page that appears for all user-related requests (ie. failed login,
 *  registration, etc.) Passes a message set by the controller for what specific error occurred.
 */

class UserError extends View {
    public function display($message) {
        //display page header
        parent::displayHeader("Error");
?>

<div class="pokeContainer">
    <div class="pokeForm missing">
<h2>ERROR</h2>
        <img src="https://64.media.tumblr.com/cac970232b25ac8b9db96118f4c7372c/tumblr_ncsfwmvcud1sqbbw2o1_400.gif" alt="">
<p><?= $message ?></p>
        <?php
        if (!isset($_SESSION['trainer'])) { ?>
            <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/user/login'">Back to Login</a>
            <?php } else { ?>
            <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
       <?php }
        ?>
        <div style="height: 20px"></div>
    </div>
</div>

<?php
//display footer
    parent::displayFooter();
    }
}
