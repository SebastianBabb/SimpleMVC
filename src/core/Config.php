<?php

namespace SimpleMVC;

/**
 * Config is a class for loading config files.
 *
 * The Config class loads all global configuration files
 * (located in the configs directory) as well provides access
 * to the routes array.
 *
 * @package SimpleMVC
 * @author  Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.0
 * @access public
 * @see https://www.simplemvc.xyz
 */
class Config {
    const CORE_CONFIG = "./configs/core";
    const CONFIG_DIR = "./configs";

    private  $routes;

    /**
     * The constructor loads SimpleMVC core configuration
     * file.
     *
     * @access public
     */
    public function __construct() {
        // Load core configuration file.
        $this->load_core_config();
    }

    public function __get($name) {
        return $this->$name;
    }

    /**
     * Loads application level configuration files.
     *
     * @access public
     */
    public function load() {
        /*
         * --------------------------------------------------------------
         * Load the config files from the config/ directory into and array
         * and strip the dot ('.', '..') directories from the configs
         * array on *nix systems.
         * --------------------------------------------------------------
         */
        $config_files = array_diff(scandir(self::CONFIG_DIR), [".",".."]);

        /*
         * --------------------------------------------------------------
         * Load each file in the config directory.
         * --------------------------------------------------------------
         */
        foreach($config_files as $file) {
            require_once(self::CONFIG_DIR . '/' . $file);
        }

        /*
         * --------------------------------------------------------------
         * Store the routes as a member. 
         * --------------------------------------------------------------
         */
        $this->routes = $routes;
    }

    /**
     * Returns an associative array of routes and their mappings
     * declared in config/routes.php
     *
     * @access public
     * @return array associative array of routes and their mappings
     */
    public function routes() {
        return $this->routes;
    }

    /**
     * Loads the core config file.
     *
     * @access private
     */
    private function load_core_config() {
        require(self::CORE_CONFIG . ".php");
    }
}
