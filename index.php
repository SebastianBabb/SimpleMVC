<?php

/**
 * Loads core source files, configs, router and
 * SimpleMVC instance.
 *
 * @package SimpleMVC
 * @author Sebastian Babb <sebastianbabb@gmail.com>
 * @version 0.9.1
 * @copyright (C) 2016 Sebastian Babb <sebastianbabb@gmail.com> 
 * @license MIT
 * @see https://www.simplemvc.xyz
 */

/*
 * --------------------------------------------------------------
 * Load core files.
 * --------------------------------------------------------------
 *
 */
const CORE_PATH = "src/core";

// Strip dot directories.
$core_files = array_diff(scandir(CORE_PATH), [".",".."]);

// Load each file in the config directory.
foreach($core_files as $file) {
    require(CORE_PATH . '/' . $file);
}

/*
 * --------------------------------------------------------------
 * Load config files.
 * --------------------------------------------------------------
 *
 */
$config = new Config();
$config->load();

/*
 * --------------------------------------------------------------
 * Parse route.
 * --------------------------------------------------------------
 */
if(isset($_SERVER['PATH_INFO']) ) {
    $router = new Router($_SERVER['PATH_INFO'], $config->routes());
    $router->parse();
} else {
    $router = new Router(null, $config->routes());  
    $router->parse();
}

/*
 * --------------------------------------------------------------
 * Warp One Engage!
 * --------------------------------------------------------------
 */
$simple_mvc = new SimpleMVC($config, $router);
$simple_mvc->start();
