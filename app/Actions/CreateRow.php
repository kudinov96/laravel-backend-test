<?php

namespace App\Actions;

use App\Models\Row;
use Carbon\Carbon;

class CreateRow
{
    public function handle(array $data)
    {
        $item       = new Row();
        $item->id   = $data["id"] ?? null;
        $item->name = $data["name"] ?? null;
        $item->date = Carbon::createFromFormat("j.n.y", $data["date"]);

        $item->save();

        return $item;
    }
}
