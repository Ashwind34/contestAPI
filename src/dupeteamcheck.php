<?php 

function dupeCheck($arr) {

    $stringArr = array_filter($arr);

    $value = $stringArr === array_unique($stringArr);

    return $value;
}

?>