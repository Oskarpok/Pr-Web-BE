<?php

declare(strict_types=1);

function formatDolarAmount(float $amount):string{
    $isNegative = $amount<0;

    if($amount>0){
        return '<span style="color:green">'.($isNegative? '-':'').'$'.number_format(abs($amount), 2).'</span>';
    }

    elseif($amount<0){
        return '<span style="color:red">'.($isNegative? '-':'').'$'.number_format(abs($amount), 2).'</span>';
    }

    else{
        return ($isNegative? '-':'').'$'.number_format(abs($amount), 2);
    }
}

function formatDate(string $date):string{
    return date('M j, Y', strtotime($date));
}