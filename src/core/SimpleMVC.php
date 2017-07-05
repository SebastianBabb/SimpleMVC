<?php

/**
 * SimpleMVC is a class that executes requests.
 *
 * SimpleMVC requires an instances of the config
 * and router classes to properly parse and route
 * requests.
 *
 * Example usage:
 * simple_mvc = new SimpleMVC($config, $router)
 *
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class SimpleMVC {
    private $config;
    private $router;
    private $controller;

    /**
     * The constructor creates an instance of the controller class
     * using using a static method from the ControllerFactory class
     * and the router instance passed as an argument on intialization.
     *
     * @param  Config $config instance of config class
     * @param  Router $router instance of router class
     * @access public
     */
    public function __construct($config, $router) {
        $this->config = $config;
        $this->router = $router;

        /*
         * --------------------------------------------------------------
         * The controller factory returns an instance of the controller
         * class specified by the router instance.  If a nonexistent
         * controller file is specified, an InvalidControllerExcpetion is
         * thrown and needs to be caught.
         * --------------------------------------------------------------
         */
        try {
            $this->controller = ControllerFactory::create($this);
        } catch(InvalidControllerException $ex) {
            $ex->message();
        }
    }
    
    /**
     * Returns the router object.
     *
     * @access public
     */
    public function get_router() {
        return $this->router;
    }

    /**
     * Returns the config object. 
     *
     * @access public
     */
    public function get_config() {
        return $this->config;
    }

    /**
     * Returns reference to the current instance of itself.
     *
     * @access public
     */
    public function instance() {
        return $this;
    }

    /**
     * Executes the specified action (method) in the controller.
     * The controller class instaniated in the constructor must 
     * have this action (method) implemented, otherwise an
     * InvalidControllerActionException will be thrown and must be
     * caught.
     *
     * @access public
     */
    public function start() {
        /*
         * --------------------------------------------------------------
         * Ensure the controller has been loaded and execute the function
         * specified in the router instance.
         * --------------------------------------------------------------
         */
        if(isset($this->controller)) {
            try {
                $this->controller->execute_action($this->router->action);
            } catch(InvalidControllerActionException $ex) {
                $ex->message();
            }
        }
    }
}
