<?php
// Routes


$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
$app->group('/api/youtube', function () {
  $this->get('/search', 'YoutubeController:search')->setName('api-youtube-search');
  $this->get('/search/page', 'YoutubeController:searchPage')->setName('api-youtube-search-page');
  $this->get('/search/video', 'YoutubeController:videoInfo')->setName('api-youtube-search-video');
});