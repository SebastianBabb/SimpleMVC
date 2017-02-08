<?php

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
class Controller {
    protected $load;
    protected $controller_actions;

    /**
     * The constructor creates an instance of the Loader class
     * and stores the name and actions of the class file that 
     * instantiated it (the child).
     *
     * @access public
     */
    public function __construct() {
        /*
         * --------------------------------------------------------------
         * Create a loader instance that the children will use to load
         * views and models.  Store the name of the controller child class
         * that called the contructor.
         * --------------------------------------------------------------
         */
        $this->load = new Loader($this);
        $this->controller_actions = get_class_methods($this);
    }

    /**
     * Executes a controller action.  If the action (method) has not been
     * declared in the controller, an InvalidControllerActionException is thrown.
     *
     * @param string @action the name of the action (method) to execute
     * @access public
     */
    public function execute_action($action) {
        /*
         * --------------------------------------------------------------
         * Ensure the action exists in the controller and execute it.
         * If the action has not been declared in the controller file,
         * an InvalidControllerActionException is thrown.
         * --------------------------------------------------------------
         */
        if(in_array($action, $this->controller_actions)) {
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
}
