<?php

/**
 * SimpleMVCException is the base exception class for SimpleMVC.
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class SimpleMVCException extends Exception {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function message() {
        echo $this->message;
    }
}

/**
 * The InvalidControllerException is an exception class that is called
 * when an attempt to load a nonexistent controller file occurs.
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class InvalidControllerException extends SimpleMVCException {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

/**
 * The InvalidControllerActionException is an exception class that is called
 * when an attempt to execute a nonexistent action occurs.
 
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class InvalidControllerActionException extends SimpleMVCException {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

/**
 * The InvalidViewException is an exception class that is called
 * when an attempt to load a nonexistent view file occurs.
 
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class InvalidViewException extends SimpleMVCException {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

 /**
 * The InvalidModelException is an exception class that is called
 * when an attempt to load a nonexistent model file occurs.
 
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class InvalidModelException extends SimpleMVCException {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

 /**
 * The InvalidModelException is an exception class that is called
 * when an attempt to load a nonexistent model file occurs.
 
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */
class InvalidVariablesException extends SimpleMVCException {
    function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
