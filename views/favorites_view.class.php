<?php
/**
 * Author: Jeremy Black
 * Date: {4/25/2024}
 * File: {favorites.class.php}
 * Description: The view that lists a user's Favorites. A 1:1 copy of the PokemonView class, with
 * some different wording.
 */

class FavoritesView extends View
{
    // uses the display method to showcase the content- passes the $pokemon variable from the controller which retrieves all pokemon
    public function display($pokemon): void
    {
        //display page header
        parent::displayHeader("View Favorites");

        echo "<div></div>"
        ?>
        <h1>Favorites</h1>
        <p>View your favorited Pokemon!</p>

        <form method="get" action="<?= BASE_URL ?>/pokemon/search">
            <input type="text" name="query_terms" id="search" placeholder="Search favorites" autocomplete="off" ">
            <input type="submit" value="Search"/>
        </form>

        <div class="pokeContainer" id="list"> <!--features the flexbox for the display-->
            <?php

            if ($pokemon === []) {
                echo "<p style='margin-top: 50px;'>You have no Pokemon in your favorites list.</p>";
            } else {
            // receieve Pokemon info from controller
            foreach ($pokemon as $mons) {
                $id = $mons->getPokemonID();
                $name = $mons->getPokemonName();
                $primary = $mons->getPrimaryTypeName();
                $secondary = $mons->getSecondaryTypeName();
                $area = $mons->getArea();
                $evolution = $mons->getEvolvesTo();
                $img = $mons->getImg();

                // display individual pokemon
                echo "<div class='pokeCard'>
                <img alt='pokemon' style='image-rendering: pixelated' src='$img'> <br>
                <span style='font-weight: bold'>$name</span> <br> $primary ";
                // if pokemon have more than one type- add a divider between types
                if ($secondary !== NULL) {
                    echo "|| $secondary";
                }
                echo "<br> $area";
                echo "<a onclick='loadDetails($id)'><div class='pokeButton'>Learn More</div></a>
                </div>";
            }

            ?>

        </div>
        <!--        The div that the details info is injected into-->
        <div id="detailsDiv"></div>

        <script>
            function loadDetails(pokemonId) {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    document.getElementById("detailsDiv").innerHTML =
                        this.responseText;
                }
                xhttp.open("GET", "<?= BASE_URL ?>/pokemon/details/" + pokemonId, true);
                xhttp.send();
            }
        </script>

        <?php
        //display page footer
        parent::displayFooter();

    }
    }
}

