<?php
include("page_start.php");

$aktion = $_GET["aktion"] ?? "";
if ($aktion == "logout") {
    session_destroy();
    header("Location: index.php");
}

// In Abhängigkeit vom Desktop oder mobilen Gerät wird ein unterschiedlich großer Text ausgegeben
if ($_SESSION["mobile"] == "mobile") {
    $font_size = 60;
} else {
    $font_size = 30;
}


echo '<div style="font-family: NothingYouCouldDo; font-size: 150px; color: olivedrab;
font-weight: lighter;">Mein Wissensbaum!</div>';
echo '<div style="font-family: QuicksandLight;
font-size: '.$font_size.'px;
font-weight: lighter;">';

echo 'Stöbern Sie in unseren aktuellen Fortbildungen und melden Sie sich direkt an, sofern noch Plätze verfügbar sind!<br>';
echo 'Wir haben für Sie auch ein Videotutorial vorbereitet:
<p></p>';
echo '<div style="font-family: NothingYouCouldDo; font-size: 80px; color: lawngreen;
font-weight: lighter; width: 700px; margin: auto; background-color: darkgray; border-radius: 20px; padding: 10px;">
<a href="uebersicht.php">Ich möchte stöbern!</a></div>';
echo '</div>';
include("page_end.php");
?>
