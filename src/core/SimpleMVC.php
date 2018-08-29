<?php

namespace SimpleMVC;

/**
 * SimpleMVC is a class that executes requests.
 *
 * SimpleMVC requires an instances of the config
 * and router classes to properly parse and route
 * requests.
 *
 * Example usage:
 * simple_mvc = new SimpleMVC(__DIR__)
 *
 * @package   SimpleMVC
 * @author    Sebastian Babb <sebastianbabb@gmail.com>
 * @version   0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com>
 * @license   MIT
 * @see https://www.simplemvc.xz
 */
class SimpleMVC
{
    /*
     * File paths.
     */
    private $documentRoot;   // Document root.

    /*
     * Instances.
     */
    private $config;            // Configuration object.
    private $router;            // Router object.
    // private $controller;

    /**
     * Store the path for the document root and build application and src/core paths.
     */
    public function __construct($docRoot)
    {
        $this->documentRoot = $docRoot;
    }

    /**
     * Start application.
     */
    public function start()
    {
        // System check.  Check php version, ect...
        $this->checkSystemConfiguration();

        // Loads core framework files.
        $this->bootstrap();

        // Load framework configuration files - Seperate into framework and app level configs?
        $this->loadConfig();
        
        // Routing.
        $this->router = new Router($_SERVER, $this->config->routes);
        $this->router->parse();

        // Middleware - Execute application level middleware.
        // $_REQUEST.
        
        /*
        * --------------------------------------------------------------
        * The controller factory returns an instance of the controller
        * class specified by the router instance.  If a nonexistent
        * controller file is specified, an InvalidControllerExcpetion is
        * thrown and needs to be caught.
        * --------------------------------------------------------------
        */
        try {
            // Get the controller instance from the factory.
            $this->controller = ControllerFactory::create($this->router);
            // Exceute the controller action.
            $this->controller->executeAction($this->router->action);
            // Call the default view.
            $this->controller->defaultView();
        } catch (InvalidControllerException $e) {
            // Handle missing controller exception.
            $e->message();
        } catch (TypeError $e) {
            // Handle invalid response type.
            echo $e->getMessage();
        } catch (Exception $e) {
            // Catch all exception.
            $e->message();
        }
    }

    /**
     * Check the system is configured properly.
     * (1)  Checks minimum version of php.
     */
    private function checkSystemConfiguration()
    {
        // The minimum major version of PHP that must be installed
        // TODO: Make a constant.  Move to global config variable?
        $MIN_MAJOR_VERION = '7';

        // Get the version of PHP.
        $version = phpversion();

        // Isolate the major version #.
        $majorVersion = explode('.', $version)[0];

        // Return a warning if the major version fails.
        if ($majorVersion != $MIN_MAJOR_VERION) {
            // TODO: Log the error.

            // Return the version error page,
            echo "<h2>Invalid PHP version.</h2>";
            echo "<p>A minimum major version of PHP {$MIN_MAJOR_VERION}.x.x is required.</p>";
            echo "<p>PHP {$version} Installed.</p>";

            // Kill the script.
            die();
        }
    }

    /**
     * Bootstrap application.  Load core files and configs.
     */
    private function bootstrap()
    {
        // Load core files.
        $this->loadCore();
    }

    /**
     * Load core files.
     */
    private function loadCore()
    {
        define('CORE_PATH', "src/core");

        /*
         * --------------------------------------------------------------
         * Load the core config files from the config/ directory into and
         * array and strip the dot ('.', '..') directories from the configs
         * array on *nix systems.
         * --------------------------------------------------------------
         */
        $core_files = array_diff(scandir(CORE_PATH), [".", ".."]);


        /*
         * --------------------------------------------------------------
         * Load each file in the config directory.
         * --------------------------------------------------------------
         */
        foreach ($core_files as $file) {
            if ($file != 'SimpleMVC.php') {
                require_once CORE_PATH . '/' . $file;
            }
        }
    }

    /**
     * Load config files.
     */
    private function loadConfig()
    {
        $this->config = new Config();
        $this->config->load();
    }

    /**
     * Returns the path of the application code.
     */
    public function appPath()
    {
        $pathComponents = array(
            $this->documentRoot,
            APP_DIR,
        );

        return implode($pathComponents, '/');
    }
}
