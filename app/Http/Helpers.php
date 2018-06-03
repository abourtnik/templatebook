<?php

function formatDatabaseDate($date , $time = false){

    return date('d F, Y' . (($time) ? ' à H:i:s' : ''), strtotime($date));
    
}