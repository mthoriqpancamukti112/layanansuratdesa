<?php

namespace App\Helpers;

class FormatHelper
{
    public static function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
