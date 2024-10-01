<?php
/**
 * Author: Jeremy Black
 * Date: {4/2/2024}
 * File: {home.class.php}
 * Description: Defines the Home class which serves as the main page for the project.
 */

class Home extends View {
    public function display(): void
    {
        //display page header
        parent::displayHeader("Nuvema Labs");

        ?>
        <div id="home" class="pokeContainer">
            <div class="pokeForm">
                <h1 style="margin-top: 15px;">Welcome to Nuvema Labs!</h1>
                <p>Nuvema Labs is your one-stop shop for all things Pokemon in the Unova region.</p>
                <img src="https://cdn.discordapp.com/attachments/1212894268205563914/1231394057528279040/IMG_0110.jpg?ex=6636cc15&is=66245715&hm=185f930bdd6ee16bf5355d3658e9d7321b68d0c004306a7c2d8cd5c5b4c1d21b&" alt="A hand-drawn logo of the company.">
                <div class="btnFlex">
                    <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/pokemon'">View Pokemon</a>
                    <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/user/register'">Create an Account</a>
                    <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/pokemon/favorites'">Favorites List</a>
                </div>
            </div>
        </div>


        <?php
        //display page footer
        parent::displayFooter();

    }
}