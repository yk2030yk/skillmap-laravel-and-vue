<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class Annual
{
    public static function get() {
        $annuals = DB::table("members")
            ->select([ DB::raw("SUBSTRING(id, 2, 2) AS annual") ])
            ->distinct()
            ->get()
            ->pluck("annual");
        return collect($annuals);
    }

    public static function parse($id) {
        return substr($id, 1, 2);
    }
}