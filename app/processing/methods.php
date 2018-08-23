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

    public function insertVideoDetails($vid, $vtitle, $cid, $ctitle, $desc, $date, $thumb)
    {
        $db = $this->getDb();

        $stmt = "INSERT IGNORE INTO videodetails (`videoid`, `videotitle`, `channelid`, `channeltitle`, `description`, `publisheddate`, 
`thumbnailurl`) VALUE (?,?,?,?,?,?,?)";
        $db->prepare($stmt)->execute([$vid, $vtitle, $cid, $ctitle, $desc, $date, $thumb]);
    }

    public function insertVideoList($term, $id, $hash)
    {
        $db = $this->getDb();

        $stmt = "INSERT IGNORE INTO searchresults (`searchedterm`, `videoid`, `resulthash`) VALUE (?,?,?) ";
        $db->prepare($stmt)->execute([$term, $id, $hash]);
    }

    public function getVideoDetails($from)
    {
        $db = $this->getDb();
        $res = [];
        $stmt = "SELECT 
                  v.videoid, v.videotitle, v.channeltitle, v.description, v.publisheddate, v.thumbnailurl, s.searchedterm 
                FROM
                  videodetails v
                INNER JOIN
                  searchresults s ON (v.videoid = s.videoid) LIMIT " . $from . ", 12";
        $sql = $db->prepare($stmt);
        $sql->execute();

        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $data;
        }
        return $res;
    }

}