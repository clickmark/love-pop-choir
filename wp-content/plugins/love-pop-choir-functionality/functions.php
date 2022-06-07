<?php
/*
Plugin Name: Love Pop Choir Functionality
Plugin URI: https://www.ryanwatson.co.uk/
Description: Custom plugin to enable custom functions within this theme
Author: Ryan Watson
Version: 1.0 Alpha
Author URI: https://www.ryanwatson.co.uk/
Text Domain: lovepopchoir_functionality
 _                                       _           _      
| |                                     | |         (_)     
| | _____   _____ _ __   ___  _ __   ___| |__   ___  _ _ __ 
| |/ _ \ \ / / _ \ '_ \ / _ \| '_ \ / __| '_ \ / _ \| | '__|
| | (_) \ V /  __/ |_) | (_) | |_) | (__| | | | (_) | | |   
|_|\___/ \_/ \___| .__/ \___/| .__/ \___|_| |_|\___/|_|_|   
                 | |         | |                            
                 |_|         |_|                            
				 
*********************
    Redirects
********************
*/

require('includes/redirects/redirects.php');

/*
*********************
    Functions
********************
*/

require('includes/general/general.php');
require('includes/terms/terms.php');
require('includes/sessions/sessions.php');
require('includes/choirs/choirs.php');
require('includes/free-trials/free-trials.php');

/*
*********************
    Handle Process
********************
*/

require('includes/process/process.php');