<?php

function formatDatabaseDate($date , $time = false){

    return date('d F, Y' . (($time) ? ' à H:i:s' : ''), strtotime($date));

}

function userBuyTemplate ($template) {

    $user_buy_template = false;

    foreach ($template->orders()->getResults() as $order) {

        if (Auth::check() && $order->user_id == Auth::user()->id ) {
            $user_buy_template = true;
            break;
        }
    }

    return $user_buy_template;
}