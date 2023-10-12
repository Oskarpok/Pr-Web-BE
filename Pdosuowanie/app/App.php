<?php

declare(strict_types=1);

function getTrnsactionFile(string $dirPath):array{
    $files = [];

    foreach(scandir($dirPath) as $file){
        if(is_dir($file)){
           continue;
        }

        $files[] = $dirPath.$file;        
    }

    return $files;
}

function getTransactions(string $fileName, ?callable $transactionHandler = null):array{
    if(!file_exists($fileName)){
        trigger_error('File"'.$fileName.'" dont exist'.E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);
    $transactions = [];

    while(($transaction = fgetcsv($file)) !== false){
        if($transactionHandler !== null){
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction;
    }
    
    return  $transactions;
}

function extractTransaction(array $transactionRow):array{

    [$date, $chcekNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$',','], '', $amount);

    return[
        'date'=>$date,
        'chcekNumber'=>$chcekNumber,
        'description'=>$description,
        'amount'=>$amount
    ];
}

function calculateTotal(array $transactions):array{
    $totals = ['TotalIncome'=>0, 'TotalExpense'=>0, 'NetTotal'=>0];

    foreach($transactions as $transaction){
        $totals['NetTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0){
            $totals['TotalIncome'] += $transaction['amount'];
        }

        else{
            $totals['TotalExpense'] += $transaction['amount'];
        }
    }
    return $totals;
}

function amountcolor($amount){
    if($amount>0){
        echo'<span style="color:green"></span>';
    }

    elseif($amount<0){
        echo'<span style="color:red"></span>';
    }
}