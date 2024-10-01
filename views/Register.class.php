<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: register.class.php
 * Description: The register form for creating a new account. Fires the "add_user" method when
 * the submit button is hit.
 */

class Register extends View
{
    public function display(): void
    {
        //display page header
        parent::displayHeader("Log in");

        ?>
            <div class="pokeContainer">

                <div style="margin-top: 60px" class="pokeForm">
                    <form action="<?= BASE_URL ?>/user/addUser" method="post">
                        <h1 style="margin-bottom: 5px">Create an Account</h1>
                        <p style="margin-bottom: 15px">Become a Pokemon trainer today!</p>
<!--                        inputs-->
                        <input name="firstName" type="text" size="10" placeholder="First name" required />
                        <input name="lastName" type="text" size="10" placeholder="Last name" required />
                        <input name="username" type="text" size="10" placeholder="Username" required />
                        <input name="password" type="text" size="10" placeholder="Password (at least 8 characters)" required />
                        <input name="checkpassword" type="text" size="10" placeholder="Confirm Password" required />

                        <input class="pokeButton" id="submit" type="submit" name="action" >
                        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/index'">Back to Home</a>
                        <p style="margin-bottom: 15px;font-size: 15px">Already have an account? <a id="registerBtn" href="<?= BASE_URL ?>/user/login">Log in now!</a></p>
                    </form>
                </div>
            </div>

            <?php
            //display page footer
            parent::displayFooter();

    }
}


