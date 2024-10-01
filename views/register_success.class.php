<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: error.php
 * Description: The error page that displays when a requested controller is not found.
 * The variable $message can be used across the webpage to display a fitting error
 * message.
 */

class Success extends View {
    public function display() {
        //display page header
        parent::displayHeader("Success");
?>

<div class="pokeContainer">
    <div class="pokeForm missing">
<h2 style="margin-bottom: 10px">Success</h2>
        <img src="https://cdn.dribbble.com/users/739669/screenshots/8553923/media/12ce76a2efd2e33215956c66da0b8b41.gif" alt="">
<p style="margin-top:15px ">You have successfully added a Pokemon to the library.</p>
        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/pokemon'">Back to Pokemon list</a>
        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
        <div style="height: 20px"></div>
    </div>
</div>

<?php
//display footer
    parent::displayFooter();
    }
}
