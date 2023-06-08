<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelRequest;
use App\Jobs\ParseExcelRowsJob;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelUploadController extends Controller
{
    public function index()
    {
        return view("excel");
    }

    public function upload(ExcelRequest $request)
    {
        $data = IOFactory::load($request->excel)->getActiveSheet()->toArray();
        dd($data);

        $chunkSize = 1000;
        $rows      = [];

        foreach ($data as $row) {
            $rows[] = $row;

            if (count($rows) >= $chunkSize) {
                ParseExcelRowsJob::dispatch($rows);
                $rows = [];
            }
        }

        if (count($rows) > 0) {
            ParseExcelRowsJob::dispatch($rows);
        }
    }
}
