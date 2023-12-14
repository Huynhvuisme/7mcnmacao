<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebController;
class AjaxController extends WebController
{
    public function ajax_get_ltd($date)
    {
        if (!$date) die();
        $lich_thi_dau = getLichThiDau($date);
        echo $lich_thi_dau;
    }
}
