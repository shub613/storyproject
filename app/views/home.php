<!DOCTYPE html>
<html>
<head>
    <title>Storyproject || Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./../../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <style>
        img {
            height: 100%;
            width: 100%;
        }
    </style>
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
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2" style="padding:20px 0px;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput"/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search">Search</button>
                            </span>
                        </div>
                    </div>
                    <div class="container" id="output"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#search").click(function () {
            var searchTerm = $('#searchInput').val();
            $.ajax({
                url: '../controllers/home.php',
                // dataType: "json",
                data: {"search": searchTerm},
                type: "post",
                success: function (data) {
                    console.log(data);
                    $('#output').html(data);
                }
            });
        });
        $('#searchInput').keypress(function (key) {
            if (key.which === 13) {
                $("#search").click();
            }
        });
    });
</script>
</body>
</html>