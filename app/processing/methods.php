<?php

class methods
{
    public function getDb()
    {
        try {
            $con = new PDO('mysql:host=localhost;dbname=storyproject;charset=utf8mb4', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            return $con;
        } catch (PDOException $e) {
            echo "<strong style='color:red;'>" . $e->getMessage() . " (There Might Be Chances of Error in the DB Connection, Please Recheck the 
database credentials in /dependencies/config.php or Contact Administrator.)</strong>";
            exit(0);
        }
    }

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

    public function insertVideoDetails($vid, $vtitle, $cid, $ctitle, $desc, $date, $thumb, $term)
    {
        $db = $this->getDb();

        $stmt = "INSERT IGNORE INTO videodetails (`videoid`, `videotitle`, `channelid`, `channeltitle`, `description`, `publisheddate`, 
`thumbnailurl`, `searchedterm`) VALUE (?,?,?,?,?,?,?,?)";
        $db->prepare($stmt)->execute([$vid, $vtitle, $cid, $ctitle, $desc, $date, $thumb, $term]);
    }

    public function insertSearchDetails($term, $time)
    {
        $db = $this->getDb();

        $stmt = "INSERT INTO searchresults (`searchedterm`, `searchedtime`) VALUE (?,?) ON DUPLICATE KEY UPDATE `searchedtime` = ?";
        $db->prepare($stmt)->execute([$term, $time, $time]);
    }

    public function getVideoDetails($from)
    {
        $db = $this->getDb();
        $res = [];
        $stmt = "SELECT 
                    videoid, videotitle, channeltitle, description, publisheddate, thumbnailurl, searchedterm
                FROM
                    videodetails 
                LIMIT " . $from . ", 12";
        $sql = $db->prepare($stmt);
        $sql->execute();

        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $data;
        }
        return $res;
    }

    public function checkSearchStatus($term)
    {
        $db = $this->getDb();
        $stmt = "SELECT 
                    searchedterm, searchedtime
                FROM
                    searchresults
                WHERE
                    searchedterm = ?";
        $sql = $db->prepare($stmt);
        $sql->execute([$term]);
        if ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $diff = abs(strtotime($data['searchedtime']) - time()) / 60;
            if ($diff >= 1) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }

    public function getVideosByTerm($term)
    {
        $db = $this->getDb();
        $res = [];
        $stmt = "SELECT 
                    videoid, videotitle, description, thumbnailurl
                FROM
                    videodetails
                WHERE
                    searchedterm = ?";
        $sql = $db->prepare($stmt);
        $sql->execute([$term]);

        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $data;
        }
        return $res;
    }

}