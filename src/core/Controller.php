<?php

namespace SimpleMVC;

/**
 * Contoller is the base controller class for SimpleMVC.
 *
 * The Controller class provides functionality common to all controllers.
 * It is meant to be extended on the application level.
 *
 * Example usage:
 * class MyController extends Controller {
 *  public function __contruct() {
 *      parent::__construct();
 *  }
 * }
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com>
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class Controller
{
    // protected $simpleMVC;
    protected $loader;
    protected $controllerActions;
    protected $displayDefaultView; // Whether or not to display default view.
    protected $defaultView; // Default view filename.
    protected $params; // View variables.
    protected $view;

    /**
     * The constructor creates an instance of the Loader class
     * and stores the name and actions of the class file that
     * instantiated it (the child).
     *
     * @access public
     */
    public function __construct()
    {
        /*
         * --------------------------------------------------------------
         * Create a loader instance that the children will use to load
         * views and models.  Store the name of the controller child class
         * that called the contructor.
         * --------------------------------------------------------------
         */
        $this->loader = new Loader($this);
        $this->controllerActions = get_class_methods($this);
        $this->displayDefaultView = true;
        // $this->defaultView =
        $this->params = null;
    }

    /**
     * Executes a controller action.  If the action (method) has not been
     * declared in the controller, an InvalidControllerActionException is thrown.
     *
     * @param string @action the name of the action (method) to execute
     * @access public
     */
    public function executeAction($action = null)
    {
        /*
         * --------------------------------------------------------------
         * Ensure no action is treated as the index action.
         * --------------------------------------------------------------
         */
        if ($action == null) $action = 'index';

        /*
         * --------------------------------------------------------------
         * Ensure the action exists in the controller and execute it.
         * If the action has not been declared in the controller file,
         * an InvalidControllerActionException is thrown.
         * --------------------------------------------------------------
         */
        if(in_array($action, $this->controllerActions)) {
            /*
             * --------------------------------------------------------------
             * Call action method of the instance.
             * --------------------------------------------------------------
             */
            $this->$action();
        } else {
            throw new InvalidControllerActionException("Error:: No such controller action {$action}");
        }
    }

    public function suppressDefaultView() {
        $this->displayDefaultView = false;
    }

    /**
     * Builds the path to the view file and converts the key => value array to
     * variables in the calling controllers symbol table.
     *
     * @param string @fileName the filename of the view to load.
     * @param array @variables referential array of variableName  => values.
     * @access public
     */
    public function view($fileName, $variables = null) {
        $this->loader->view($fileName, $variables);
    }

    /**
     * Set the varialbles that will be available in the view.
     */
    public function setParams($params) {
        $this->params = $params;
    }

    /**
     * Display the default view only if it has not been explicitly suppressed.
     */
    public function defaultView() {
        if ($this->displayDefaultView) {
            $this->loader->view($this->view, $this->params);
        }
    }

    /**
     * Loads the view file into the current context.
     * Called by the loader->view function after it builds the
     * view file path and loads the variables into the controllers
     * symbol table.
     */
    public function loadView($filePath) {
        require_once $filePath;
    }

    /**
     * Returns the contens of a view file.
     *
     * @param string @file_path the path of the view file to load
     * @access public
     */
    public function load_view_source($file_path) {
        return file_get_contents($file_path);
    }
}
