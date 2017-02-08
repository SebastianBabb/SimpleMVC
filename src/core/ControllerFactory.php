<?php

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
class ControllerFactory {
    /**
     * Returns an instance of the controller class specified by
     * the router instance argument.  If the controller class file
     * does not exist, an InvalidControllerException is thrown.
     * 
     * @param Router $router an instance of the router class. 
     * @return Controller an instance of the controller class.
     * @access public
     */
    public static function create($router) {
        /*
         * --------------------------------------------------------------
         * Ensure the controller file exists and import it.
         * --------------------------------------------------------------
         */
        if(file_exists($router->controller_file)) {
            require($router->controller_file);
        } else {
           throw new InvalidControllerException("Error:: No such controller {$router->controller_file}");
        }

        return new $router->controller();
    }
}
