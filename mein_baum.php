<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");

$aktion = $_GET["aktion"] ?? "";
$feldhoehe = $_SESSION["font_size"] * 1.4;
switch($aktion) {
    
}
echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
</style>
Schau, wie toll sich dein Wissensbaum entwickelt:
<p>
<img src="pics/baum.png" style="position: relative; height: 200px; margin: auto; left: 40%">
</p>';


echo '<p>Ihre bisheringen Erfolge:</p>';

include("page_end.php");
?>
