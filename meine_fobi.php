<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");

$aktion = $_GET["aktion"] ?? "";
$feldhoehe = $_SESSION["font_size"] * 1.4;
switch($aktion) {
    case 'anmelden':
        $fobi = new Fortbildung;
        $fobi->ID = $_GET["id_fortbildung"];
        $fobi->lesen();
        $fobi->anmelden();
        echo 'Sie haben sich soeben für die Fortbildung '.$fobi->titel.' angemeldet und '.$fobi->punkte.' Punkte für Ihren Wissensbaum hinzugewonnen!.<br>';

        
    break;
}
echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
</style>
Zu diesen Fortbildungen haben Sie sich angemeldet:';


echo '<p>Ihre bisheringen Erfolge:</p>';

include("page_end.php");
?>
