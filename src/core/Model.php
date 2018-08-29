<?php

namespace SimpleMVC;

/**
 * Model is the base model class for SimpleMVC.
 *
 * The Model class provides functionality common to all models.
 * It is meant to be extended on the application level.
 *
 * Example usage:
 * class MyModel extends Model {
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
class Model
{
    public function __construct()
    {
        // Handle construction.
    }
}
