<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>
<?
include_once "functions.php";
if (isset($_GET['hotel'])) {
    $hotel = $_GET['hotel'];
    $link = connect();
    $select = 'select * from hotels where id=' . $hotel;
    $res = mysqli_query($link, $select);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $hname = $row['hotel'];
    $hstars = $row['stars'];
    $hcost = $row['cost'];
    $hinfo = $row['info'];
    mysqli_free_result($res);
    echo '<h2 class="text-uppercase text-center">'.$hname.'</h2>';
    echo '<div class="row">';
    $select = 'select imagepath from images where hotelid=' . $hotel;
    $res = mysqli_query($link, $select);
    echo '<span class="label label-info">Watch your pictures</span>';
    echo '<ul id="gallery">';
    $i = 0;
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        echo '<div class="flex-container"><li><img src="../'.$row['imagepath'].'" alt="image hotel" align="middle" width="400px" heigh="400px" ></li>';
    }
    mysqli_fetch_array($res);
    
}
echo '<li><h4>Stars: '.$hstars .'</h4>';
echo '<h4>Cost: '. $hcost .'</h4>';
echo '<h4>Info: '. $hinfo .'</h4></li></div>';
echo '</ul>';
?>
</body>
</html>
