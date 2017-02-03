<?php

/**
 * Router is a class for parsing url paths.
 *
 * Router is a class that parses url paths into their
 * component parts and assembles controller file paths.
 *
 * @package SimpleMVC
 * @author  Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.0
 * @access public
 * @see https://www.simplemvc.xyz
 */
class Router {
    private $path;
    private $routes;
    private $controller_file;
    private $controller;
    private $action;
    
    /**
     * The constructor loads the url path to be parsed and routes to be mapped
     *
     * @param string $path url path to be parsed (myserver.com/Controller/action)
     * @param array  $routes associative array of routes
     * @access public
     */
    public function __construct($path=null, $routes=null) {
        $this->path = $path;
        $this->routes = $routes;
    }

    /**
     * Magic getter method
     *
     * @param string $name name of the member variable to return
     * @access public
     */
    public function __get($name) {
        return $this->$name;
    }

    /**
     * Magic setter method
     *
     * @param string $name name of the member variable to set 
     * @param string $value value to set the variable to
     * @access public
     */
    public function __set($name, $value) {
        $this->$name = $value;
    }

    /**
     * Parses the url path and maps them to the associated routes.
     * After execution, the members controller_file, controller and
     * action are set and accessible. 
     *
     * @param string $name name of the member variable to set 
     * @param string $value value to set the variable to
     * @access public
     */
    public function parse() {
        if(1 < strlen($this->path)) {
            /*
             * --------------------------------------------------------------
             * A route has been set isolate controller and action and check
             * it against predefined routes in routes.php.
             * --------------------------------------------------------------
             */
            $path = substr($this->path, 1);
            
            /*
             * --------------------------------------------------------------
             * Remove trailing slash when a action is not set.
             * --------------------------------------------------------------
             */
            if(substr($path, -1)  == '/') {
                $path = chop($path, '/');
            }

            /*
             * --------------------------------------------------------------
             * Check url against routers config.
             * --------------------------------------------------------------
             */
            if(isset($this->routes[$path])) {
                $path = $this->routes[$path];
            }
            
            /*
             * --------------------------------------------------------------
             * Split the path into its component parts (strip whitespace)
             * --------------------------------------------------------------
             */
            $path_components = array_diff(explode('/',$path), ['']);
            $this->controller = $path_components[0];

            /*
             * --------------------------------------------------------------
             * Store the action.  If no action is set, default to index.
             * --------------------------------------------------------------
             */
            if(1 < count($path_components)) {
                $this->action = $path_components[1];
            } else {
                $this->action = "index";
                $path = $path . '/' . $this->action;
            }

            /*
             * --------------------------------------------------------------
             * Build the controller file path.
             * --------------------------------------------------------------
             */
            $this->controller_file = "app/controllers/" . $this->controller . ".php";
        } else {
            /*
             * --------------------------------------------------------------
             * No path is set.  Load default route set in configs/routes 
             * --------------------------------------------------------------
             */
            if(isset($this->routes["default"])) {
                $path_components =  explode('/', $this->routes["default"]);
                $this->controller = $path_components[0];
                /*
                 * --------------------------------------------------------------
                 * If default route does not specificy an action, set it to
                 * index.
                 * --------------------------------------------------------------
                 */
                if(empty($path_components[1])) {
                    $this->action = "index";
                } else {
                    $this->action = $path_components[1];
                }

                $this->controller_file = "app/controllers/" . $this->controller . ".php";
            } else {
                echo "Error: No default route set in routes.php";
            }
        }
    }
}
