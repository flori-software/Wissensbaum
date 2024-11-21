<?php


function get_mandatsreferenz() {
    $mysqli = MyDatabase();
    $sql = "SELECT * FROM mandatsreferenz WHERE `ID` = 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $nummer = $row['nummer'];
    $nummer++;
    $sql = "UPDATE mandatsreferenz SET nummer = $nummer WHERE `ID` = 1";
    $result = $mysqli->query($sql);
    $mysqli->close();
    return $nummer;
}





?>