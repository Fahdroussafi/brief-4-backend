<?php


function dump($var){
    echo '<pre>';
    if(is_string($var)) echo $var.'<br>';
    if(is_array($var)) print_r($var);
}