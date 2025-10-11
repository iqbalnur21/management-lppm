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