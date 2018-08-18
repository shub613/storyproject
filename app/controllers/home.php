<?php
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
require_once '../../vendor/autoload.php';

include_once '../processing/methods.php';

$DEVELOPER_KEY = 'AIzaSyBvHpdniaWOv5w53ChLlxKPxsygS8jQgpg';

$client = new Google_Client();
$client->setDeveloperKey($DEVELOPER_KEY);

$youtube = new Google_Service_YouTube($client);

$obj = new methods();

$response = methods::searchListByKeyword($youtube, 'snippet', array('maxResults' => 25, 'q' => 'hello', 'type' => 'video'));

$videoList = '';
foreach ($response['items'] as $searchResult) {
    $videoList .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
        "<a href=http://www.youtube.com/watch?v=" . $searchResult['id']['videoId'] . " target=_blank>Watch This Video</a>");

}
echo($videoList);

//videosListById($youtube,
//    'snippet,contentDetails,statistics',
//    array('id' => 'JFcgOboQZ08'));