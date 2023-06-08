<?php

namespace App\Http\Controllers;

use App\Models\Row;

class ExcelController extends Controller
{
    public function index()
    {
        $rows = Row::orderBy("date")->get();

        $groupedData = [];

        foreach ($rows as $row) {
            $date = $row->date->format("d.m.Y");

            $groupedData[$date][] = [
                "id"   => $row->id,
                "name" => $row->name,
                "date" => $row->date->format("d.m.Y"),
            ];
        }

        return view("excel", [
            "data" => $groupedData,
        ]);
    }
}
