<?php
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
require_once '../vendor/autoload.php';

session_start();

$DEVELOPER_KEY = 'AIzaSyBvHpdniaWOv5w53ChLlxKPxsygS8jQgpg';

$client = new Google_Client();
$client->setDeveloperKey($DEVELOPER_KEY);

$youtube = new Google_Service_YouTube($client);

function searchListByKeyword($service, $part, $params)
{
    $params = array_filter($params);
    $response = $service->search->listSearch(
        $part,
        $params
    );
    $videos = '';

    foreach ($response['items'] as $searchResult) {
        $videos .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
            "<a href=http://www.youtube.com/watch?v=" . $searchResult['id']['videoId'] . " target=_blank>Watch This Video</a>");

    }
    echo ($videos);
}

function videosListById($service, $part, $params)
{
    $params = array_filter($params);
    $response = $service->videos->listVideos(
        $part,
        $params
    );

    echo json_encode($response);
}

searchListByKeyword($youtube,
    'snippet',
    array('maxResults' => 25, 'q' => 'hello', 'type' => 'video'));

//videosListById($youtube,
//    'snippet,contentDetails,statistics',
//    array('id' => 'JFcgOboQZ08'));