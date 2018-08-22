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

        $sql = "INSERT IGNORE INTO videodetails (`videoid`, `videotitle`, `channelid`, `channeltitle`, `description`, `publisheddate`, 
`thumbnailurl`) VALUE (?,?,?,?,?,?,?)";
        $db->prepare($sql)->execute([$vid, $vtitle, $cid, $ctitle, $desc, $date, $thumb]);
    }

    public function insertVideoList($term, $id, $hash)
    {
        $db = $this->getDb();

        $sql = "INSERT IGNORE INTO searchresults (`searchedterm`, `videoid`, `resulthash`) VALUE (?,?,?) ";
        $db->prepare($sql)->execute([$term, $id, $hash]);
    }

}