<?php
/*
 * Author: Jeremy Black, Nathan Ensley
 * Date: 4/2/2024
 * File: index_controller.class.php
 * Description: Default controller; sets the initial view to the homepage.
 */

class IndexController {
    // Calls the index class and displays it on the page
    public function index(): void {
        $view = new Home();
        $view->display();
    }

}

