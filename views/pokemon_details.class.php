<?php
/**
 * Author: Jeremy Black
 * Date: {4/11/2024}
 * File: {pokemon_details.class.php}
 * Description: The view for the "about" section of a specific Pokemon from the
 * Pokemon page. Is injected to the PokemonView page through AJAX.
 */

class PokemonDetail extends View
{
    // uses the display method to showcase the content- passes the $details variable from the controller which retrieves a specific Pokemon
    public function display($details): void
    {
        //retrieve Pokemon details by calling get methods
        $id = $details->getPokemonID();
        $name = $details->getPokemonName();
        $primary = $details->getPrimaryTypeName();
        $secondary = $details->getSecondaryTypeName();
        $ability = $details->getAbilityName();
        $desc = $details->getAbilityDescr();
        $area = $details->getArea();
        $evolution = $details->getEvolvesTo();
        $img = $details->getImg();
        //var_dump($details); //- Displays data types of the variables.

        ?>

        <div style="justify-content: center;" class="pokeContainer"> <!--features the flexbox for the display-->
            <div class="shadow">

                <div class="detailsBox">
                    <div id="pokeBox">
                        <div style="margin-left:15px"><?= $name ?></div>
                        <img style="image-rendering: pixelated" src="<?= $img ?>"
                             alt="A moving pixel sprite of <?= $name ?>.">
                    </div>
                    <div id="pokeInfo">
                        <div><span class="bold">Primary type:</span> <?= $primary ?></div>
                        <?php
                        if (!is_string($secondary)) { // If Pokemon has no secondary type/If secondary = null, remove it
                            echo "<div></div>";
                        } else {
                            echo "<div><span class='bold'>Secondary type:</span> $secondary</div>";
                        } ?>
                        <div><span class="bold">Ability:</span> <?= $ability ?></div>
                        <div><span class="bold">Description:</span> <?= $desc ?></div>
                        <?php
                        if (!is_string($area)) { // If Pokemon is not based in any area/If area = null, remove it
                            echo "<div></div>";
                        } else {
                            echo "<div><span class='bold'>Area:</span> $area</div>";
                        }

                        if ($evolution === NULL) { // If Pokemon does not have an evolution/If evolution = null, remove it
                            echo "<div></div>";
                        } else {
                            echo "<div><span class='bold'>Evolves to: </span> #$evolution </div>";
                        }
                        ?>
                        <?php

                        # Make sure the user is logged in before presenting any of these options
                        if (isset($_SESSION['trainer'])) {

                            # If this specific pokemon ID is already in the favorites then show the remove buttong
                            $indexOfPokemonID = isset($_SESSION['trainer']['favorites']) ? array_search($id, $_SESSION['trainer']['favorites']) : false;

                            # Assuming it returns an index other than false, AKA it finds a result
                            if ($indexOfPokemonID !== false) {
                                # Then show the remove button
                                ?>
                                <form method='post' action='<?= BASE_URL ?>/user/removeFav/<?= $id ?>'>
                                    <button type="submit" name="favoritePokemon" class="pokeButton">Remove from
                                        Favorites
                                    </button>
                                </form>

                                <?php
                            } # Otherwise show the add button
                            else { ?>
                                <form method='post' action='<?= BASE_URL ?>/user/addFav/<?= $id ?>'>
                                    <button type="submit" name="favoritePokemon" class="pokeButton">Add to Favorites
                                    </button>
                                </form>
                            <?php }

                        }

                        ?>
                        <a href="<?= BASE_URL ?>/pokemon">
                            <div class="pokeButton">Back to Pokemon</div>
                        </a>

                    </div>

                </div>
            </div>
        </div> <!--closing tag for pokecontainer-->
        <?php
    }
}