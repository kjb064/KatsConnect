<?php
include_once 'includes/header.php';
include 'Calendar/Calendar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KatsConnect - Campus Direct</title>
    <!-- Using Bootstrap 3.3.7!! -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #b3d9ff">
<!-- Map and Calendar -->
<div class="row">
    <div class="col-sm-1"></div>
    <!-- Map -->
    <div class="col-md-4">
        <h2 align="center">Campus Map</h2>
        <div class="embed-responsive embed-responsive-4by3" align="center">
            <iframe class="embed-responsive-item"
                    src="https://maphub.net/embed/39614"
                    frameborder="1"
                    allowfullscreen>
            </iframe>
        </div>
    </div>
    <div class="col-sm-2"></div>
    <!-- Calendar -->
    <div class="col-md-4">
        <h2 align="center">KatSafe</h2>
        <!-- Calendar goes here -->
        <div class="embed-responsive embed-responsive-4by3" align="center">
            <iframe class="embed-responsive-item"
                    src="">
            </iframe>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
<!-- KatSafe Alerts -->
<div class="row" style="margin-top: 50px;">
    <div class="col-sm-2"></div>
    <div class="col-md-8">
        <h2 align="center">Academic Calendar</h2>
        <div class="container" align="center">
            <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
            <table class="table table-bordered">
                <tr>
                    <th>S</th>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
                </tr>
                <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
                ?>
            </table>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

</body>
</html>
<?php
include_once 'includes/footer.php';
?>
