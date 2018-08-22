<?php
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
session_start();
require_once '../../vendor/autoload.php';

include_once '../processing/methods.php';

$DEVELOPER_KEY = 'AIzaSyBvHpdniaWOv5w53ChLlxKPxsygS8jQgpg';

$client = new Google_Client();
$client->setDeveloperKey($DEVELOPER_KEY);

$youtube = new Google_Service_YouTube($client);

$obj = new methods();

if(isset($_POST['search']) && trim($_POST['search']) != '') {
    $_SESSION['search'] = $_POST['search'];

    $response = $obj->searchListByKeyword($youtube, 'snippet', array('maxResults' => 25, 'q' => $_SESSION['search'], 'type' => 'video'));

    $videoList = '';
//    echo '<pre>';
//    print_r($response);
    foreach ($response['items'] as $searchResult) {
        //$videoList .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
            //"<a href=http://www.youtube.com/watch?v=" . $searchResult['id']['videoId'] . " target=_blank>Watch This
        // Video</a>");
        $videoList .= '<div class="card col-sm-12"><div class="row"><div class="col-sm-3 text-center">';
        $videoList .= '<img src="'. $searchResult["snippet"]["thumbnails"]["high"]["url"] .'">';
        $videoList .= '</div><div class="card-body col-sm-9">';
        $videoList .= '<h5 class="card-title">' . $searchResult["snippet"]["title"] . '</h5>';
        $videoList .= '<p class="card-text">'. $searchResult["snippet"]["description"] .'</p>';
        $videoList .= '<a href="http://www.youtube.com/watch?v=' . $searchResult["id"]["videoId"] . '" target=_blank class="card-link">Watch This Video</a>';
        $videoList .= '</div></div></div>';
    }
    echo($videoList);
}