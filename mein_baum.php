<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");


$feldhoehe = $_SESSION["font_size"] * 1.4;
$namen = array("Keimling", "Sprössling", "Jungbaum", "blühender Baum", "Weiser Baum");
$grenzen = array(0, 10, 30, 50, 70);

echo '<div style="font-size: '.$_SESSION["font_size"].'px; margin: 20px;">';
if(isset($_SESSION["id_benutzer"])) {
    $benutzer = new Benutzer(id: $_SESSION["id_benutzer"]);
    // In Abhängigkeit der Punkte den Namen des Baumes ermitteln
    $name = $namen[0];
    for($i = 0; $i < count($namen); $i++) {
        if($benutzer->punkte >= $grenzen[$i]) {
            $name = $namen[$i];
            $stufe = $i;
        }
    }
    $stufe++;
    echo '<h2>Willkommen '.$benutzer->vorname.' '.$benutzer->nachname.'!</h2>';
    echo '<p>Dein Wissensbaum wächst und gedeiht. Hier kannst du ihn betrachten und pflegen.</p>';
    echo 'Schau, was für ein schöner '.$name.' du schon bist!:
    <p>Du hast bisher '.$benutzer->punkte.' Punkte gesammelt.<br>
    <img src="pics/stufe'.$stufe.'.png" style="position: relative; 30%; margin: auto; left: 10%;">
    </p>';
    if($stufe < 5) {
        echo '<p>Deine nächste Stufe: <span style="font-weight: bold; font-size: px;">'.$namen[$stufe].'</span> beim Erreichen von '.$grenzen[$stufe].' Fortbildungspunkten.</p>';
    } else {
        echo '<p>Herzlichen Glückwunsch! Du hast verstanden, was lebenslanges Lernen ist. Hab weiterhin viel Freude an der Entwicklung deiner Fähigkeiten und deines Wissens!</p>';
    }
    

} else {
    echo 'Du bist nicht eingeloggt. <a href="login.php">Hier einloggen</a>';
}

echo '</div>';



include("page_end.php");
?>
