<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/human_android_comunicator.php");

echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
</style>';

echo '<div style="font-family: QuicksandLight;
font-size: '.$_SESSION["font_size"].'px;
font-weight: lighter;">';

$hoehe_feld = $_SESSION["font_size"] * 1.4;

echo 'Benutzername:<br>
<form action="meine_hilfe.php?aktion=login" method="post">
<input type="text" name="benutzername" id="benutzername" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
Passwort:<br>
<input type="password" name="passwort" id="passwort" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
<p><input type="submit" value="Login" style="width: 100%; height: '.$hoehe_feld.'px;"></p></form>';




include("page_end.php");
?>