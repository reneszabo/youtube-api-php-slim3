<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
  $settings = $c->get('settings')['renderer'];
  return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Register Flash messages
$container['flash'] = function () {
  return new \Slim\Flash\Messages();
};

// monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings')['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
  return $logger;
};

//Guzzle HTTP client
/* return GuzzleHttp\Client */
//$container['curl'] = function() {
//  $guzzle = new \GuzzleHttp\Client();
//  return $guzzle;
//};
//controllers

$container['YoutubeController'] = function($container){
  return new \Humber\Controllers\YoutubeController($container);
};