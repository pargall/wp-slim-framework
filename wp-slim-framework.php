<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 7/30/13
 * Time: 10:20 AM
 * Plugin Name: Wordpress Slim framework
 * Description: Slim framework integration with Wordpress
 * Version: 1.0
 * Author: Constantin Botnari
 * License: GPLv2
 */
require_once 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

add_filter('rewrite_rules_array', function ($rules) {
    $new_rules = array(
        '(slim/api/)' => 'index.php',
    );
    $rules = $new_rules + $rules;
    return $rules;
});

add_action('init', function () {
    if (strstr($_SERVER['REQUEST_URI'], '/slim/api')) {
        $slim = new \Slim\Slim();
        do_action('slim_mapping',$slim);
        $slim->run();
    }
});