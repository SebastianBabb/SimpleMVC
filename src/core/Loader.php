<?php

namespace SimpleMVC;

/**
 * The Loader class loads application level file (models, views, ect).
 *
 * Example usage:
 *  $load = new Loader() 
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class Loader {
    private $view_dir;
    private $model_dir;
    private $ci;

    /**
     * The constructor builds the directory paths for views, models, ect..
     * and stores an instance of the controller class as a member variable.
     *
     * @param Controller $ci an instance of the controller class.
     */
    public function __construct($ci) {
        $this->view_dir = "app/" . VIEW_DIR . "/";
        $this->model_dir = "app/" . MODEL_DIR . "/";
        $this->ci = $ci; // Controller instances.
    }

    /**
     * Loads the specified view file or returns its contents as a string.
     *
     * @param string $view_file the name of the view file to load (with or without extension)
     * @param array $variables referential array of variables that will be available to the view
     *        ex. array('name'=>'SimpleMVC') will be accessible in the view as $name
     */
    public function view($view_file, $variables=null) {
        /*
         * --------------------------------------------------------------
         * Check the file extension and ensure it is a php file.  If the
         * extension is not php, let it throw an error.  If the view_file
         * name was passed without an extension, append ".php" to it.
         * --------------------------------------------------------------
         */
        $file_ext = pathinfo($view_file, PATHINFO_EXTENSION);

        /*
         * --------------------------------------------------------------
         * Add the file extension.
         * --------------------------------------------------------------
         */
        if(empty($file_ext)) {
            $view_file = $view_file . ".php";
        }

        /*
         * --------------------------------------------------------------
         * Build the view file path.
         * --------------------------------------------------------------
         */
        $view_file_path = $this->view_dir . $view_file;

        /*
         * --------------------------------------------------------------
         * If the file exists, load the view file.
         * If the view file is nonexistent, an InvalidViewException is
         * thrown.
         * --------------------------------------------------------------
         */
        if(file_exists($view_file_path)) {
            /*
             * --------------------------------------------------------------
             * Load the view variables only if a referential array was passed
             * otherwise, throw an error.
             * --------------------------------------------------------------
             */
            if(is_array($variables) && !is_int(array_keys($variables)[0])) {
                $this->load_variables($variables); // Throw incorrect data format excpetion in not array of key value pairs.
            } else {
                // Null variables is fine.  Dont throw an error.
                if (!is_null($variables)) {
                    throw new InvalidVariablesException("Error:: Invalid variables argument for view.");
                }
            }

            $this->ci->loadView($view_file_path);
        } else {
            throw new InvalidViewException("Error:: No such View {$view_file_path}");
        }
    }

    /**
     * Returns the source code of view_file.
     *
     * @param string $view_file the name of the view file to load (with or without extension)
     * @return string the content of the view file 
     */
    public function view_source($view_file) {
        /*
         * --------------------------------------------------------------
         * Check the file extension and ensure it is a php file.  If the
         * extension is not php, let it throw an error.  If the view_file
         * name was passed without an extension, append ".php" to it.
         * --------------------------------------------------------------
         */
        $file_ext = pathinfo($view_file, PATHINFO_EXTENSION);

        if(empty($file_ext)) {
            $view_file = $view_file . ".php";
        }

        /*
         * --------------------------------------------------------------
         * Build the view file path.
         * --------------------------------------------------------------
         */
        $view_file_path = $this->view_dir . $view_file;

        /*
         * --------------------------------------------------------------
         * If the view file exists, return the file contents as a string.
         * If the view file is nonexistent, an InvalidViewException is
         * thrown.
         * --------------------------------------------------------------
         */
        if(file_exists($view_file_path)) {
            return $this->ci->load_view_source($view_file_path);
        } else {
            throw new InvalidViewException("Error:: No such View {$view_file_path}");
        }
    }

    /**
     * Loads the specified model file.
     *
     * @param string $model_file the name of the model file to load (with or without extension)
     * @param string $alt_name alternate variable name for the model object
     */
    public function model($model_file, $alt_name=null) {
        /*
         * --------------------------------------------------------------
         * Check the file extension and ensure it is a php file.  If the
         * extension is not php, let it throw an error.  If the view_file
         * name was passed without an extension, append ".php" to it.
         * --------------------------------------------------------------
         */
        $file_ext = pathinfo($model_file, PATHINFO_EXTENSION);

        if(empty($file_ext)) {
            $model_file = $model_file . ".php";
            $model = $model_file;
        } else {
            $model = str_replace(".php", "", $model_file);
        }

        /*
         * --------------------------------------------------------------
         * Build the model file path.
         * --------------------------------------------------------------
         */
        $model_file_path = $this->model_dir . $model_file;

        /*
         * --------------------------------------------------------------
         * If the string return value is false, load the model file.
         * Otherwise, return the file contents as a string.
         * If the model file is nonexistent, an InvalidViewException is
         * thrown.
         * --------------------------------------------------------------
         */
        if(file_exists($model_file_path)) {
            require_once($model_file_path); 
            /*
             * --------------------------------------------------------------
             * Create an instance of the model in the controller's context.
             * If the alt_name parameter is set, use it to name the model
             * variable.  Otherwise, use the class name.
             * --------------------------------------------------------------
             */
            if(isset($alt_name)) {
                $this->controller_instance->{$alt_name} = new $model();
            } else {
                $this->controller_instance->{$model} = new $model();
            }
        } else {
            throw new InvalidModelException("Error:: No such Model {$model_file_path}");
        }
    }

    /**
     * Loads the variables that will be accessible to the view into the controller instance.
     *
     * @param referential array $variables dictionary of variable names to values
     */
    private function load_variables($variables) {
        foreach ($variables as $name=>$value) {
            $this->ci->$name = $value;
        }
    }
}
