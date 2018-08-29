<?php

/**
 * Controller template.
 */
class &TemplateController& extends \SimpleMVC\Controller {
    public function __construct() {
        parent::__construct();
        
        $this->view = '&ViewFile&';
    }

    public function index() {
        $params = [
            'msg' => '&DefaultMessage&'
        ];

        // Set the variables that will be available to the view.
        $this->setParams($params);
    }
}