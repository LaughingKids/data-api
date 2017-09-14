<?php
/*
Plugin Name: Aspen Api
Plugin URI: https://bitbucket.org/tddbsydney/aspen-api
Description: A restful api with auth for aspen brand website
Version: 1.0
Author: tddbsydney developer team (Thomas Laughingkids Wang)
Author URI: https://bitbucket.org/tddbsydney
License: "MIT"
*/

require_once __DIR__.'/vendor/autoload.php';
use Aspen\DataApplication;

$app = new DataApplication();