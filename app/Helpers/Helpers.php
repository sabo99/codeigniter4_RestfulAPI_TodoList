<?php

namespace App\Helpers;

use CodeIgniter\I18n\Time;

class Helpers
{
    function getResultEncrypted($value)
    {
        $sha1 = sha1($value);
        $md5 = md5($sha1);
        $crypt = crypt($md5, $sha1);

        $md52 = md5($crypt);
        $sha12 = sha1($md52);

        $combine = $crypt . strrev($sha12) . $sha1 . $md5 . strrev($md52);
        $finalEncrypt = $crypt . $combine;

        $result = $finalEncrypt . md5($finalEncrypt);

        return $result;
    }

    function timeToHumanize($dateTime)
    {
        $timeParse = Time::parse($dateTime)->toLocalizedString('MMM d, yyyy hh:mm:ss');
        return Time::parse($timeParse)->humanize();
    }

    function currentDateTime($dateTime)
    {
        // return Time::parse($dateTime, 'Asia/Jakarta');
        return Time::parse($dateTime, 'America/Chicago');
    }
}
