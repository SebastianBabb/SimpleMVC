<?php

/*
 * Routing lets you configure your application to accept clean SEO
 * friendly urls that do not map to physical files.
 *
 * ex.
 *      url = "myapplication.com/projects/simplemvc"
 *      
 *      routes entry => $routes["projects"]["simplemvc"] = "Notes/building_an_mvc"
 *
 *      The url will route to the controller file Notes.php and call its 
 *      action (method) building_an_mvc.  If no action is specified, the 
 *      index function is assumed.
 *
 */
$routes["default"] = "DefaultController/";
//$routes["DefaultController/example_function"] = "DefaultController/index";
