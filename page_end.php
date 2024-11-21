<?php
// An dieser Stelle benötige ich ein Feld welches auf Cookies die beim Einloggen zur Verwaltung der Session notwendig sind hinweist und die Möglichkeit bietet, diese zu akzeptieren
// Das Feld sollte sich am unteren Rand der Seite befinden und sollte sich nicht über den Inhalt legen
// Wir prüfen zuerst, ob es bereits einen Cookie gibt, der bestätigt, dass der Nutzer die Cookies akzeptiert hat

if (!isset($_COOKIE["cookie_accepted"])) {
    // Wenn nicht, dann wird das Feld angezeigt
    echo '<div id="cookie_info" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: gray; color: white; text-align: center; padding: 10px; font-size: '.$_SESSION["font_size"].'px;">
    Diese Website verwendet Cookies für die Verwaltung der Sessions für eingeloggte Vereinsmitglieder.&nbsp;<a href="Impressum_datenschutz.php">Mehr erfahren</a>
    <button onclick="document.cookie = \'cookie_accepted=1; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/\'; document.getElementById(\'cookie_info\').style.display = \'none\';" style="font-size: '.($_SESSION["font_size"] * 0.6).'px;">Cookies akzeptieren</button>
    </div>';
}


echo '</div></div>
	</body>
</html>';



?>