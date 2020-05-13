<?php 

  session_start();

  if(!isset($_SESSION["log"])){
    header("Location: index.php");
  }


?>


<!DOCTYPE html>
<html>
<head>
<title>OpenStreetMap</title>
<link rel="icon" href="resources/icon.png">
<meta charset="UTF-8">
<meta name="description" content="Login form for OpenStreetMap">
<meta name="keywords" content="OpenStreetMap">
<meta name="author" content="Mersiha Komic,Emira Sehic,Ezudina Topalovic,Belmin Muhovic">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<style>
  body{
      background: linear-gradient(to right bottom, #1cc7d0 ,#013ca6, #013ca6,#1cc7d0);
      height: 773px;
    }
  
  #menu{
    float: left;
    position: relative;
    width:500px;
    height: 750px;
    margin-top: 10px;
    margin-left: 20px;
    margin-bottom: 5px;
    background: rgba(0, 0, 0, 0.22);
  }
  #menu img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 50px;
  }
  #menu a{
    color: white;
  }
  #form{
    margin-left: 30px;
    color: white;
  }
  #lout{
    position:absolute;
    bottom:10px;
    right:0;
    left:0;
    text-align:center;
  }

  
	#mapid { 
    float: right;
    width: 800px;
		height: 750px;
    margin-top: 10px;
    margin-right: 10px;
	}
</style>

</head>
<body>

<div id="wrapper">
  <div id="menu">
    <h1 style="color: white; text-align: center">OpenStreetMap</h1>
    <img src="resources/icon.png" width="128" height="128" alt="openstreetmap icon">
    <h3 style="color: white; margin-left: 5px;">Select map type: </h2>
    <form id="form" action="" method="POST">
      <input type="radio" name="map" value="light-v10">
      <label for="light-v10">Light</label><br>
      <input type="radio" name="map" value="dark-v10">
      <label for="dark-v10">Dark</label><br>
      <input type="radio" name="map" value="streets-v11">
      <label for="streets-v11">Streets</label><br>
      <input type="radio" name="map" value="outdoors-v11">
      <label for="outdoors-v11">Outdoors</label><br>
      <input type="radio" name="map" value="satellite-streets-v11">
      <label for="satellite-streets-v11">Satellite</label><br><br>
      <input type="submit" name="submit" value="Show map">
    </form>

    <h3 style="color: white; margin-left: 5px;">Options: </h2>
    <form id="form" action="" method="POST">
      <input type="radio" name="option" value="show_markers">
      <label for="show_markers">Show markers</label><br><br>
      <input type="submit" name="options" value="Submit">
    </form> 

    <div id="lout">
      <form action="" method="POST">
        <input type="submit" name="logout" value="LOGOUT">
      </form>
    </div>

  </div>
  <div id="mapid"></div>
</div>




<script >

	var mymap = L.map('mapid').setView([43.856430, 18.413029], 15);

</script>


<?php

 require_once("connection.php");


if(isset($_POST['submit'])){

  $selected_radio = $_POST['map'];
  $type = "";

  if($selected_radio == "light-v10"){
    $type .= "light-v10";
  }else if($selected_radio == "dark-v10"){
    $type .= "dark-v10";
  }else if($selected_radio == "streets-v11"){
    $type .= "streets-v11";
  }else if($selected_radio == "outdoors-v11"){
    $type .= "outdoors-v11";
  }else if($selected_radio == "satellite-streets-v11"){
    $type .= "satellite-streets-v11";
  }

  $_SESSION["map_type"] = $type;
  get_map($type);

}

if(isset($_POST["options"])){

  $selected_radio = $_POST["option"];

  if($selected_radio == "show_markers"){
    show_markers();
  }

}

if(isset($_POST['logout'])){
  logout();
}


function get_map($type){

  echo "<script>
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, <a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox/".$type."',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZXp1IiwiYSI6ImNrOXIwdnd6MjA2cmUzZnBpMXJyZmowZDMifQ.dqDRow_mFwetvHk1IOQOFg'
  }).addTo(mymap);
   </script>";

}


function show_markers(){
  if(!isset($_SESSION["map_type"])){
    echo "<script type='text/javascript'>alert('Niste odabrali tip mape');</script>";
    return;
  }

  get_map($_SESSION["map_type"]);

  $conn = new Connection("localhost","root","openstreetmap");
  $conn->connect();
  $query = "SELECT * FROM objects";
  $result = $conn->execute_query($query);
  while ($row = $result->fetch_array(MYSQLI_ASSOC)){

    echo "<script>
       L.marker([".$row['latitude'].",". $row['longitude']."]).addTo(mymap)
      .bindPopup('<h3 style=\"text-align:center;\">".$row['name']."</h3><p style=\"text-align:justify;\">".$row['description']."</p>')
      </script>";
  }

}


function logout(){
  setcookie("username", false, time() - 3600);
  setcookie("password", false, time() - 3600);
  session_unset();
  session_destroy();
  header ("Location: index.php");
}


?>


</body>
</html>