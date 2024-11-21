<?php
// Es wird in einer Sesseionvariablen gespeichert, ob die Seite vom Desktop oder von einem mobilen Gerät aus geöffnet wurde


// Wenn die Sessionvariable noch nicht gesetzt ist, wird geprüft, ob es sich um ein mobiles Gerät handelt
$mobile = false;

if (isset($_SERVER["HTTP_USER_AGENT"])) {
    $mobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobile|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
// Wenn es sich um ein mobiles Gerät handelt, wird die Sessionvariable auf "mobile" gesetzt
if ($mobile) {
    $_SESSION["mobile"] = "mobile";
} else {
    $_SESSION["mobile"] = "desktop";
}



// Test
# echo $_SESSION["mobile"];


?>