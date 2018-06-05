<?php

function formatDatabaseDate($date , $time = false){

    return date('d F, Y' . (($time) ? ' à H:i:s' : ''), strtotime($date));

}

function userBuyTemplate ($template) {
    return $template->orders->filter(function ($order) {return $order->user_id == \Illuminate\Support\Facades\Auth::user()->id;})->count() === 1;
}

function userVoteUpTemplate ($template) {
    return $template->votes->filter(function ($votes) {return ($votes->status === 1 && $votes->user_id == \Illuminate\Support\Facades\Auth::user()->id); })->count() === 1;
}

function userVoteDownTemplate ($template) {
    return $template->votes->filter(function ($votes) {return ($votes->status === 0 && $votes->user_id == \Illuminate\Support\Facades\Auth::user()->id); })->count() === 1;
}