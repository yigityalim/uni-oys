<?php

const PROJECT_NAME = 'yigitozgur';
const METHOD = 'AES-128-ECB';
const KEY = 'secret';
const SEASON = 1;

function openssl_enc($data): bool|string
{
    return openssl_encrypt($data, METHOD, KEY);
}

function openssl_dec($data): bool|string
{
    return openssl_decrypt($data, METHOD, KEY);
}

function getMatchingDateRange($date): bool
{
    $months = [
        'Ocak' => 'January', 'Şubat' => 'February', 'Mart' => 'March',
        'Nisan' => 'April', 'Mayıs' => 'May', 'Haziran' => 'June',
        'Temmuz' => 'July', 'Ağustos' => 'August', 'Eylül' => 'September',
        'Ekim' => 'October', 'Kasım' => 'November', 'Aralık' => 'December'
    ];

    if ($date === 'Genel') {
        return false;
    }

    list($start, $end) = explode(' - ', $date);

    foreach ($months as $tr => $en) {
        $start = str_replace($tr, $en, $start);
        $end = str_replace($tr, $en, $end);
    }

    $startDate = DateTime::createFromFormat('j F', $start)->setTime(0, 0, 0);
    $endDate = DateTime::createFromFormat('j F', $end)->setTime(23, 59, 59);

    if ($startDate > $endDate) {
        $endDate->modify('+1 year');
    }

    $currentDate = new DateTime();

    $currentDateThisYear = clone $currentDate;
    $currentDateNextYear = clone $currentDate;
    $currentDateNextYear->modify('+1 year');

    if (($currentDate >= $startDate && $currentDate <= $endDate) ||
        ($currentDateThisYear >= $startDate && $currentDateThisYear <= $endDate) ||
        ($currentDateNextYear >= $startDate && $currentDateNextYear <= $endDate)
    ) {
        return true;
    }

    return false;
}
