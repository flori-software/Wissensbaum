<?php
session_start();
include("mobile_or_desktop.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	</head>
	<link rel="stylesheet" type="text/css" href="beauty.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<body>
	<div class="mittelteil" id="mittelteil">
	<img src="pics/titelbild.jpg" class="titelbild">
<?php	
$menu_inhalte = Array();

$menu_inhalte[0]["name"] = "Startseite";
$menu_inhalte[0]["link"] = "index.php";
$menu_inhalte[1]["name"] = "Übersicht";
$menu_inhalte[1]["link"] = "uebersicht.php";
$menu_inhalte[2]["name"] = "Meine Fortbildungen";
$menu_inhalte[2]["link"] = "meine_fobi.php";
$menu_inhalte[3]["name"] = "Mitarbeiter";
$menu_inhalte[3]["link"] = "mitarbeiter.php";
$menu_inhalte[4]["name"] = "Impressum";
$menu_inhalte[4]["link"] = "impressum_datenschutz.php";
$menu_inhalte[5]["name"] = "Mein Baum";
$menu_inhalte[5]["link"] = "mein_baum.php";
if(isset($_SESSION["id_benutzer"])) {
	$menu_inhalte[6]["name"] = "Logout";
	$menu_inhalte[6]["link"] = "index.php?aktion=logout";
} else {
	$menu_inhalte[6]["name"] = "Login";
	$menu_inhalte[6]["link"] = "login.php";
}

if ($_SESSION["mobile"] == "mobile") {
	
	echo '<div style="background: linear-gradient(to bottom, olivedrab, lawngreen);" id="mobiles_menu"><img src="pics/menu_icon.png" style="display: inline-block; height: 50px;">
	<span style="display: inline-block; font-size: 60px; font-family: QuicksandLight; color: white;">&nbsp;&nbsp; Mehr Informationen</span></div>';
	foreach($menu_inhalte as $key=>$menupunkt) {
		echo '<a  href="'.$menupunkt["link"].'" ';
		// Externe Links sollen in einem separaten Fenster geöffnet werden
		if (substr($menupunkt["link"],0,4) == "http") {
			echo 'target="_blank"';
		}
		echo '><div style="background: linear-gradient(to bottom, olivedrab, lawngreen); color: white; padding: 10px; font-size: 50px; display: none;" class="menupunkt_mobile">'.$menupunkt["name"].'</div></a>';
	}
} else {
	foreach($menu_inhalte as $key=>$menupunkt) {
		echo '<a class="menu" href="'.$menupunkt["link"].'" ';
		// Externe Links sollen in einem separaten Fenster geöffnet werden
		if (substr($menupunkt["link"],0,4) == "http") {
			echo 'target="_blank"';
		}
		echo '>'.$menupunkt["name"].'</a>';
	}
	echo '<p>';
}
echo '<div class="inhalt">';
// In Abhängigkeit vom Desktop oder mobilen Gerät wird ein unterschiedlich großer Text ausgegeben
if ($_SESSION["mobile"] == "mobile") {
    $_SESSION["font_size"] = 60;
} else {
    $_SESSION["font_size"] = 30;
}



?>

<script>
// Die folgende Funktion soll die Felder, die zur Klasse menupunkt_mobile gehören ein- und ausblenden je nachdem, ob sie gerade sichtbar sind oder nicht
$(document).ready(function() {
	$("#mobiles_menu").click(function() {
		$(".menupunkt_mobile").toggle();
	});
});


</script>