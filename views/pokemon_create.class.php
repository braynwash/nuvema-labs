<?php
/**
 * Author: Jeremy Black
 * Date: {4/4/2024}
 * File: pokemon_create.class.php
 * Description: The create form for adding a new Pokemon to the database.
 */

class PokemonAdd extends View
{
    // uses the display method to showcase the content- passes the $pokemon variable from the controller which retrieves all pokemon
    public function display(): void
    {
        //display page header
        parent::displayHeader("Add a Pokemon");

        ?>
        <h1 style="text-align: center;padding-top: 10px;margin-bottom: 10px">Add a pokemon</h1>
        <p style="text-align: center">Inputs with an asterik (*) can be left empty.</p>
            <div class="pokeContainer">
                <div class="pokeForm">
                    <!--Calls controller method -->
                    <form action=" <?= BASE_URL ?>/pokemon/addNewPokemon" method="post">

                        <!--inputs-->
                        <input name="pokemonName" type="text" size="10" placeholder="Pokemon name" required />
                        <div class="selectDiv">
                            <label for="primaryType">Type:</label>
                        <select name="primaryType" required>
                            <option value="1">Grass</option>
                            <option value="2">Fire</option>
                            <option value="3">Water</option>
                            <option value="4">Normal</option>
                            <option value="5">Electric</option>
                            <option value="6">Rock</option>
                            <option value="7">Ground</option>
                            <option value="8">Bug</option>
                            <option value="9">Fighting</option>
                            <option value="10">Flying</option>
                            <option value="11">Poison</option>
                            <option value="12">Ice</option>
                            <option value="13">Psychic</option>
                            <option value="14">Ghost</option>
                            <option value="15">Dragon</option>
                            <option value="16">Dark</option>
                            <option value="17">Steel</option>
                        </select>
                            <label for="secondaryType">*Second type:</label>
                        <select name="secondaryType">
                            <option value="NULL"></option>
                            <option value="1">Grass</option>
                            <option value="2">Fire</option>
                            <option value="3">Water</option>
                            <option value="4">Normal</option>
                            <option value="5">Electric</option>
                            <option value="6">Rock</option>
                            <option value="7">Ground</option>
                            <option value="8">Bug</option>
                            <option value="9">Fighting</option>
                            <option value="10">Flying</option>
                            <option value="11">Poison</option>
                            <option value="12">Ice</option>
                            <option value="13">Psychic</option>
                            <option value="14">Ghost</option>
                            <option value="15">Dragon</option>
                            <option value="16">Dark</option>
                            <option value="17">Steel</option>
                        </select>
                                <label for="abilityName">Ability:</label>
                        <select name="abilityName" required>
                            <option value="1">Victory Star</option>
                            <option value="2">Overgrow</option>
                            <option value="3">Blaze</option>
                            <option value="4">Torrent</option>
                            <option value="5">Run Away</option>
                            <option value="6">Illuminate</option>
                            <option value="7">Pickup</option>
                            <option value="8">Intimidate</option>
                            <option value="9">Sand Rush</option>
                            <option value="10">Limber</option>
                            <option value="11">Gluttony</option>
                            <option value="12">Forewarn</option>
                            <option value="13">Synchronize</option>
                            <option value="14">Big Pecks</option>
                            <option value="15">Super Luck</option>
                            <option value="16">Lightning rod</option>
                            <option value="17">Motor Drive</option>
                            <option value="18">Sturdy</option>
                            <option value="19">Unaware</option>
                            <option value="20">Klutz</option>
                            <option value="21">Sand Force</option>
                            <option value="22">Healer</option>
                            <option value="23">Guts</option>
                            <option value="24">Sheer Force</option>
                            <option value="25">Swift Swim</option>
                            <option value="26">Hydration</option>
                            <option value="27">Poison Touch</option>
                            <option value="28">Inner Focus</option>
                            <option value="29">Swarm</option>
                            <option value="30">Leaf Guard</option>
                            <option value="31">Chlorophyll</option>
                            <option value="32">Poison Point</option>
                            <option value="33">Prankster</option>
                            <option value="34">Infiltrator</option>
                            <option value="35">Moxie</option>
                            <option value="36">Own Tempo</option>
                            <option value="37">Reckless</option>
                            <option value="38">Shell Armor</option>
                            <option value="39">Water Absorb</option>
                            <option value="40">Hustle</option>
                            <option value="41">Shed Skin</option>
                            <option value="42">Magic Guard</option>
                            <option value="43">Mummy</option>
                            <option value="44">Solid Rock</option>
                            <option value="45">Defeatist</option>
                            <option value="46">Sticky Hold</option>
                            <option value="47">Stench</option>
                            <option value="48">Illusion</option>
                            <option value="49">Frisk</option>
                            <option value="50">Overcoat</option>
                            <option value="51">Technician</option>
                            <option value="52">Cute Charm</option>
                            <option value="53">Keen Eye</option>
                            <option value="54">Ice Body</option>
                            <option value="55">Sap Sipper</option>
                            <option value="56">Static</option>
                            <option value="57">Effect Spore</option>
                            <option value="58">Cursed Body</option>
                            <option value="59">Compound Eyes</option>
                            <option value="60">Unnerve</option>
                            <option value="61">Iron Barbs</option>
                            <option value="62">Plus</option>
                            <option value="63">Minus</option>
                            <option value="64">Levitate</option>
                            <option value="65">Telepathy</option>
                            <option value="66">Flash Fire</option>
                            <option value="67">Flame Body</option>
                            <option value="68">Rivalry</option>
                            <option value="69">Mold Breaker</option>
                            <option value="70">Snow Cloak</option>
                            <option value="71">Regenerator</option>
                            <option value="72">Rough Skin</option>
                            <option value="73">Iron Fist</option>
                            <option value="74">Defiant</option>
                            <option value="75">Justified</option>
                            <option value="76">Turbo Blaze</option>
                            <option value="77">Teravolt</option>
                            <option value="78">Serene Grace</option>
                            <option value="79">Download</option>
                        </select>
                            <label for="area">*Area:</label>
                        <select name="area" id="area">
                            <option value="NULL"></option>
                            <option value="1">Event</option>
                            <option value="2">Starter</option>
                            <option value="3">Route 1</option>
                            <option value="4">Route 7</option>
                            <option value="5">Route 10</option>
                            <option value="6">Route 2</option>
                            <option value="7">Route 5</option>
                            <option value="8">Pinwheel Forest - Inside</option>
                            <option value="9">Dreamyard</option>
                            <option value="10">Dreamyard Basement</option>
                            <option value="11">Route 3</option>
                            <option value="12">Route 6</option>
                            <option value="13">Route 12</option>
                            <option value="14">Wellspring Cave</option>
                            <option value="15">Twist Mountain</option>
                            <option value="16">Victory Road</option>
                            <option value="17">Mistralton Cave</option>
                            <option value="18">Cold Storage</option>
                            <option value="19">Pinwheel Forest</option>
                            <option value=20>Route 8</option>
                            <option value="21">Moor of Icirrus</option>
                            <option value="22">Lostlorn Forest</option>
                            <option value="23">Abundant Shrine</option>
                            <option value="24">Wherever water flows</option>
                            <option value="25">Desert Resort</option>
                            <option value="26">Relic Castle</option>
                            <option value="27">Route 18</option>
                            <option value="28">Route 4</option>
                            <option value="29">The Maze of Relic Castle</option>
                            <option value="30">Fossil</option>
                            <option value="31">Route 9</option>
                            <option value="32">Route 16</option>
                            <option value="33">Driftveil Drawbridge</option>
                            <option value="34">Marvelous Bridge</option>
                            <option value="35">Outside Cold Storage</option>
                            <option value="36">Dragonspiral Tower</option>
                            <option value="37">Outside Dragonspiral Tower</option>
                            <option value="38">Route 17</option>
                            <option value="39">Route 18</option>
                            <option value="40">Chargestone Cave</option>
                            <option value="41">Celestial Tower</option>
                            <option value="42">Route 14</option>
                            <option value="43">Route 11</option>
                            <option value="44">Relic Castle Maze End</option>
                            <option value="45">Mistralton Cave Guidance Chamber</option>
                            <option value="46">Pinwheel Forest Rumination Field</option>
                            <option value="47">Victory Road Trial Chamber</option>
                            <option value="48">Roaming Unova</option>
                            <option value="49">N's Castle</option>
                            <option value="50">Giant Chasm Inner Cave</option>
                        </select>
                        </div>
                        <input name="evolvesTo" type="text" size="10" placeholder="Pokemon's evolution*" value="NULL"/>
                        <input name="img" type="text" size="10" placeholder="Photo of Pokemon" required />

                        <input class="pokeButton" id="submit" type="submit" name="action" >
                        <a class="pokeButton" onclick="window.location.href='<?= BASE_URL ?>/pokemon'">Back to Pokemon</a>
                    </form>
                </div>



            </div>



            <?php
            //display page footer
            parent::displayFooter();

    }
}


