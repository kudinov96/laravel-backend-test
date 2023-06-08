<?php

namespace App\Actions;

use App\Models\Row;
use Carbon\Carbon;

class CreateRow
{
    public function handle(array $data)
    {
        $item       = new Row();
        $item->id   = $data["id"];
        $item->name = $data["name"];

        $date = Carbon::createFromFormat("d.m.y", $data["date"]);
        if (!$date) {
            $date = Carbon::createFromFormat("j.n.y", $data["date"]);
        }

        $item->date = $date;
        $item->save();

        return $item;
    }
}
