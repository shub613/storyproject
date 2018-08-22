<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="col-sm-8 offset-sm-2">
            <ul id="output" class="list-unstyled"></ul>
        </div>

    </div> <!-- row -->


</div> <!-- container -->
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
