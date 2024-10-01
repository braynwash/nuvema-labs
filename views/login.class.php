<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: login.class.php
 * Description: The view for the Login page. Allows users to log in using an exsiting account through
 * the "verify" method.
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
                    <form action="<?= BASE_URL ?>/user/verify" method="post">
                        <h1 style="margin-bottom: 10px">Log in</h1>
                        <p style="margin-bottom: 15px">Sign in to add to your favorites list and create new Pokemon!</p>
<!--                        inputs-->
                        <input name="username" type="text" size="10" placeholder="Username" required />
                        <input name="password" type="text" size="10" placeholder="Password" required />

                        <input class="pokeButton" id="submit" type="submit" name="action" >
                        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
                        <p style="margin-bottom: 10px;font-size: 15px">Don't have an account? <a id="registerBtn" href="<?= BASE_URL ?>/user/register">Register now!</a></p>
                        <p style="margin-bottom: 25px;font-size: 15px">Forgot your password? <a id="registerBtn" href="<?= BASE_URL ?>/user/reset">Reset password</a></p>
                    </form>
                </div>
            </div>

            <?php
            //display page footer
            parent::displayFooter();

    }
}


