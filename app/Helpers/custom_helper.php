<?php

use CodeIgniter\Database\Config;

function dateFormat($timestamp)
{
    if (!is_numeric($timestamp[0])) {
        return $timestamp;
    }

    $dateTime = new DateTime($timestamp);

    $daysOfWeek = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $dayOfWeek = $daysOfWeek[$dateTime->format('l')];
    $formatter = new IntlDateFormatter(
        'id_ID',
        IntlDateFormatter::LONG,
        IntlDateFormatter::NONE,
        'Asia/Jakarta',
        IntlDateFormatter::GREGORIAN
    );

    $formattedDate = $formatter->format($dateTime);
    $formattedDateTime = $dayOfWeek . ', ' . $formattedDate;

    echo $formattedDateTime; // Output: "Selasa, 21 Maret 2023"
}

function url($url_index)
{
    $isLive = strpos(current_url(), 'balrafa.tech') !== false;
    $url_explode = explode('/', $_SERVER['REQUEST_URI']);
    if ($isLive) {
        return $url_explode[$url_index + 1];
    } else {
        return $url_explode[$url_index];
    }
}
