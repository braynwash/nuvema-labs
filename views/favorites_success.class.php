<?php
/**
 * Author: Jeremy B
 * Date: 4/4/2024
 * Name: error.php
 * Description: The success page that appears when a user's request to add/remove a Pokemon is
 * completed. Passes a message in the display method that changes depending on if the user
 * wanted to add/remove.
 */

class FavoritesSuccess extends View
{
    public function display($message)
    {
        //display page header
        parent::displayHeader("Success");
        ?>

        <div class="pokeContainer">
            <div class="pokeForm missing">
                <h2 style="margin-bottom: 10px">Success</h2>
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/0a290752-d7eb-45e3-aa31-8e71b544cde0/da7pc71-fc7e1b55-6a6d-428d-bcc7-c5d28b778311.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzBhMjkwNzUyLWQ3ZWItNDVlMy1hYTMxLThlNzFiNTQ0Y2RlMFwvZGE3cGM3MS1mYzdlMWI1NS02YTZkLTQyOGQtYmNjNy1jNWQyOGI3NzgzMTEuZ2lmIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.NZ9GgJBXN6108pwHMtBqx2R9xNI3KIp4Ggr_MyqSkUI"
                     alt="">
                <p style="margin-top:15px "><?= $message ?></p>
                <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/user/favorites'">Favorites list</a>
                <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/pokemon'">Back to Pokemon list</a>
                <div style="height: 20px"></div>
            </div>
        </div>

        <?php
//display footer
        parent::displayFooter();
    }
}
