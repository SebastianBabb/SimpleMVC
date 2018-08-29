<?php

namespace SimpleMVC;

/**
 * The ControllerFactory class instaniates controller objects.
 *
 * The ControllerFactory class instantiates controller objects
 * based on parameters specified by an instance of the Router
 * class.
 *
 * Example usage:
 *  my_controller = ControllerFactory::create($router);
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com>
 * @license MIT
 * @see https://www.simplemvc.xyz
 */

class ControllerFactory
{
    /**
     * Returns an instance of the controller class specified by
     * the router instance argument.  If the controller class file
     * does not exist, an InvalidControllerException is thrown.
     *
     * @param $simpleMVC an instance of the SimpleMVC class which contains
     *        Router, Config and other members.
     * @return Controller an instance of the controller class specified by the router.
     * @access public
     */
    public static function create($router): Controller
    {
        /*
         * --------------------------------------------------------------
         * Ensure the controller file exists and import it.
         * --------------------------------------------------------------
         */
        if (file_exists($router->controllerFile)) {
            require_once $router->controllerFile;
        } else {
            $errMsg = "Error:: No such controller {$router->controllerFile}";
            
            throw new InvalidControllerException($errMsg);
        }

        // Create and return the instance of the controller class.
        return new $router->controllerClass();
    }
}
