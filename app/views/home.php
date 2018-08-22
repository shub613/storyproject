<!DOCTYPE html>
<html>
<head>
    <title>Storyproject || Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img{
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="videos.php">Videos</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
            </ul>
        </li>
    </ul>
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
        <div class="container" id="output">
        </div>
    </div>
</div>
<script src="../../assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#search").click(function () {
            var searchTerm = $('#searchInput').val();
            $.ajax({
                url: '../../app/controllers/home.php',
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