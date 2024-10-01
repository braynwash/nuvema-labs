<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: {pokemon_view.class.php}
 * Description: The view for the "list" of Pokemon/the "Pokemon" page.
 */

class Login extends View
{
    public function display(): void
    {
        //display page header
        parent::displayHeader("Log in");

        ?>
            <div class="pokeContainer">

                <div style="margin-top: 60px" class="pokeForm">
                    <form action="/controllers/pokemon_controller.class.php" method="post">
                        <h1 style="margin-bottom: 10px">Log in</h1>
                        <p style="margin-bottom: 15px">Sign in to add to your favorites list and create new Pokemon!</p>
<!--                        inputs-->
                        <input name="username" type="text" size="10" placeholder="Username" required />
                        <input name="password" type="text" size="10" placeholder="Password" required />

                        <input class="pokeButton" id="submit" type="submit" name="action" >
                        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
                        <p style="margin-bottom: 15px;font-size: 15px">Don't have an account? <a id="registerBtn" href="<?= BASE_URL ?>/user/register">Register now!</a></p>
                    </form>
                </div>
            </div>

            <?php
            //display page footer
            parent::displayFooter();

    }
}


