<?php
/**
 * Author: Jeremy Black
 * Date: {4/2/2024}
 * File: {index_view.class.php}
 * Description: Defines header and footer methods to be used across
 * all views.
 */

class View
{

    // Creates a method for the header to be used across all views
    static public function displayHeader($page_title): void
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title> <?php echo $page_title ?> </title>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/styles.css'/>
            <script>
                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";
            </script>
        </head>
        <body>
        <nav class="nav">
            <?php
            //if the user is logged in, display their name instead of a "Login" button.
            if (isset($_SESSION['trainer'])) {
                $_SESSION['trainer']['name'] = $_SESSION['trainer']['fName'];
                $name = $_SESSION['trainer']['name'];
                echo "<div style='margin-left: 20px;'>Hello, $name!</div>";
            } else { //If a user is NOT logged in, display the Log in button.
                echo "<a href='" . BASE_URL . "/user/login' style='margin-left: 20px;'>Log in</a> ";
            }

            ?>

            <a href="<?= BASE_URL ?>/index">Home</a>
            <a href="<?= BASE_URL ?>/pokemon">Pokemon</a>
            <a style="margin-right: 20px;" href="<?= BASE_URL ?>/user/favorites">Favorites</a>
            <!--Will only be available if user is logged in-->
            <?php
            // if a user is logged in, display a "log out" button that will break their session when clicked.
            if (isset($_SESSION['trainer'])) {
                echo "<a href='" . BASE_URL . "/user/logout' style='margin-right: 20px;'>Log out</a>";
            }
            ?>
        </nav>
        <div class="content">
        <?php
    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter(): void
    {
        ?>
        </div>
        <footer>
            <p>All Rights Reserved.</p>
        </footer>
        <!--        <script type="text/javascript" src="/www/js/ajax_autosuggestion.js"></script>-->
        </body>
        </html>
        <?php
    } //end of displayFooter function
}