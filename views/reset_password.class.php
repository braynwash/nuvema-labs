<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: reset_password.class.php
 * Description: The reset password form for users to... reset their passwords.
 */

class ResetView extends View
{
    public function display(): void
    {
        //display page header
        parent::displayHeader("Reset Password");

        ?>
            <div class="pokeContainer">

                <div style="margin-top: 60px" class="pokeForm">
                    <form action="<?= BASE_URL ?>/user/resetPassword" method="post">
                        <h1 style="margin-bottom: 10px">Reset Password</h1>
<!--                        inputs-->
                        <input name="username" type="text" size="10" placeholder="Username" required />
                        <input name="password" type="text" size="10" placeholder="New Password" required />

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


