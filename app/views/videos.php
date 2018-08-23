<!DOCTYPE html>
<html>
<head>
    <title>Storyproject || Videos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./../../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="../../assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../../assets/js/jsrender.js" type="text/javascript"></script>
    <script src="../../assets/js/helpers.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <nav class="navbar navbar-expand-lg">
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a aria-expanded="false" role="button" href="./home.php" class="nav-link">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a aria-expanded="false" role="button" href="./videos.php" class="nav-link">
                                <i class="fab fa-youtube"></i> Videos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content">
            <div class="container-fluid">
                <div class="row" id="video-placeholder"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var config = {
            url: '../controllers/videos.php',
            data: {"from": "0"},
            placeholder: '#video-placeholder',
            template: '#video-card-template',
            element: 'body'
        };
        populateCards(config);
    });
</script>

<script id="video-card-template" type="text/html">
    <div class="col-sm-3">
        <div class="card">
            <img class="card-img-top" src="{{:thumbnailurl}}">
            <div class="card-body">
                <h5 class="card-title"> {{:videotitle}} </h5>
                <h6 class="card-subtitle mb-2 text-muted"> Searched Term : {{:searchedterm}} </h6>
                <h6 class="card-subtitle mb-2 text-muted"> Channel : {{:channeltitle}} </h6>
                <p class="card-text">{{:description}}</p>
                <a href="http://www.youtube.com/watch?v={{:videoid}}" target=_blank class="card-link btn btn-primary
                btn-sm">Watch This Video</a>
            </div>
        </div>
    </div>
</script>

</body>
</html>