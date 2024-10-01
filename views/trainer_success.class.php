<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: trainer_success.class.php
 * Description: The success page that appears for all user-related requests (ie. successful login,
 * registration, etc.) Passes a message set by the controller for what specific success occurred.
 */

class TrainerSuccess extends View
{
    public function display($message)
    {
        //display page header
        parent::displayHeader("Success");
        ?>

        <div class="pokeContainer">
            <div class="pokeForm missing">
                <h2 style="margin-bottom: 10px">Success</h2>
                <img src="https://i.gifer.com/JEKO.gif" alt="">
                <p style="margin-top:15px "><?= $message ?></p>
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
