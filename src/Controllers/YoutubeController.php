<?php

namespace Humber\Controllers;

use GuzzleHttp\Client;
use \Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

/**
 * User: Humber Team
 * Date: 25/10/16
 * Time: 10:34 PM
 */
class YoutubeController extends BaseController
{
  const KEY = "AIzaSyBvvXT_ffOBDHGRVc8LI2IYTEJ5FrdDOeo";
  const BASE_URL = 'https://www.googleapis.com/youtube/v3/';
  /* @var $curl Client */
  protected $curl;
  public function __construct(ContainerInterface $ci) {
    $this->ci = $ci;
    $this->curl = new Client(['base_uri' => self::BASE_URL]);
  }

  /**
   * Search for videos in youtube with a string query
   *
   * @param $request Request
   * @param $response Response
   * @param $args array
   * @return Response
   */
  public function search($request, $response, $args){
    $q                =   $request->getParam('q','haiku');
    $q.= ' haiku';
    $limit            =   $request->getParam('limit',20);
    $youtubeResponse  =   $this->curl->request('GET', 'search', [
      'query'=>[
        'part' => 'snippet',
        'type' => 'video',
        'order' => 'date',
        'q' => $q,
        'maxResults' => $limit,
        'videoDuration' => 'short',
        'key'=> self::KEY
      ]
    ]);
    return $response->withHeader('Content-Type','application/json')->write($youtubeResponse->getBody()->getContents());
  }
  public function searchPage($request, $response, $args){
    /* @var $request Request */
    /* @var $response Response */
    /* @var $youtubeResponse ResponseInterface */
    $q                =   $request->getParam('q','haiku');
    $q.= ' haiku';
    $token            =   $request->getParam('pageToken');
    $limit            =   $request->getParam('limit',20);
    $youtubeResponse  =   $this->curl->request('GET', 'search', [
      'query'=>[
        'part' => 'snippet',
        'type' => 'video',
        'order' => 'date',
        'pageToken' => $token,
        'q' => $q,
        'maxResults' => $limit,
        'videoDuration' => 'short',
        'key'=> self::KEY
      ]
    ]);
    return $response->withHeader('Content-Type','application/json')->write($youtubeResponse->getBody()->getContents());
  }
  public function videoInfo($request, $response, $args){
    /* @var $request Request */
    /* @var $response Response */
    /* @var $youtubeResponse ResponseInterface */
    $ids                =   $request->getParam('ids');
    $youtubeResponse  =   $this->curl->request('GET', 'videos', [
      'query'=>[
        'part' => 'contentDetails, snippet',
        'id' => $ids,
        'key'=> self::KEY
      ]
    ]);
    return $response->withHeader('Content-Type','application/json')->write($youtubeResponse->getBody()->getContents());
  }


}