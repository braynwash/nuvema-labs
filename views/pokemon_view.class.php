<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: {pokemon_view.class.php}
 * Description: The view for the "list" of Pokemon/the "Pokemon" page.
 */

class PokemonView extends View
{
    // uses the display method to showcase the content- passes the $pokemon variable from the controller which retrieves all pokemon
    public function display($pokemon): void
    {
        //display page header
        parent::displayHeader("View Pokemon");

        echo "<div></div>"
        ?>
        <h1>Pokemon</h1>
        <p>Click on a Pokemon to learn more!</p>

        <form method="get" action="<?= BASE_URL ?>/pokemon/search">
            <input type="text" name="query_terms" id="search" placeholder="Find a Pokemon" autocomplete="off" ">
            <input type="submit" value="Search"/>
        </form>

        <div class="pokeContainer" id="list"> <!--features the flexbox for the display-->
            <?php
            //If no Pokemon are found in the DB
            if ($pokemon === 0) {
                echo "No Pokemon were found.";
            } else {
            //Jeremy; this dumps all the pokemon objects for debugging (Thank you Sarah! - J)
            //var_dump($pokemon);

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

        <!--        Button that redirects to the create form-->
        <?php
        //If users aren't logged in, don't display the create feature.
        if (!isset($_SESSION['trainer'])) {
            echo "<div></div>";
        } else { //if user is logged in, display the create feature ?>
            <div class="center">
                <a style="display: block" class="pokeButton" id="add"
                   onclick="window.location.href='<?= BASE_URL ?>/pokemon/add'">Not seeing a Pokemon? Add one here!</a>
            </div>
        <?php }
        ?>


        <!--        The div that the details info is injected into through AJAX-->
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

