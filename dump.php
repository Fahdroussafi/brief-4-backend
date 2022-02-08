<?php


function dump($var = 'line'){
    echo '<pre>';
    if($var == 'line') {echo __LINE__;return;}
    if(is_string($var)) echo $var.'<br>';
    if(is_array($var)) print_r($var);
}