<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/klasse_fortbildung.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");

$aktion = $_GET["aktion"] ?? "";
$feldhoehe = $_SESSION["font_size"] * 1.4;
switch($aktion) {
    case 'anmelden':
        $fobi = new Fortbildung;
        $fobi->ID = $_GET["id_fortbildung"];
        $fobi->lesen();
        $fobi->anmelden($_SESSION["id_benutzer"]);
        echo 'Sie haben sich soeben für die Fortbildung '.$fobi->titel.' angemeldet und '.$fobi->punkte.' Punkte für Ihren Wissensbaum hinzugewonnen!<br>';

        
    break;

    case 'login':
        $benutzer = new Benutzer;
        $benutzer->login();
    break;
}

// Überprüfen, ob der Benutzer eingeloggt ist
if(isset($_SESSION["id_benutzer"])) {
    $benutzer = new Benutzer(id: $_SESSION["id_benutzer"]);
    echo '<h2>Willkommen '.$benutzer->vorname.' '.$benutzer->nachname.'!</h2>';

    echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
    </style>
    Zu diesen Fortbildungen haben Sie sich angemeldet:';
    $benutzer->show_my_fobi();

    
} else {
    echo '<h2>Willkommen!</h2>';
    echo '<p>Bitte loggen Sie sich ein, um die Übersicht Ihrer Fortbildungen einzusehen.</p>';
}



include("page_end.php");
?>
