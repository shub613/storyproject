<?php


class methods
{
    public function searchListByKeyword($service, $part, $params)
    {
        $params = array_filter($params);
        $response = $service->search->listSearch(
            $part,
            $params
        );
        return $response;
    }

    public function videosListById($service, $part, $params)
    {
        $params = array_filter($params);
        $response = $service->videos->listVideos(
            $part,
            $params
        );

        echo json_encode($response);
    }

}