<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelRequest;
use App\Jobs\ParseExcelRowsJob;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelUploadController extends Controller
{
    public function index()
    {
        return view("excel-upload");
    }

    public function upload(ExcelRequest $request)
    {
        $activeSheet   = IOFactory::load($request->excel)->getActiveSheet();
        $uniqueKey     = uniqid();
        $chunkSize     = 1000;
        $rows          = [];
        $processedRows = 0;

        foreach ($activeSheet->getRowIterator() as $row) {
            $rowData = [];

            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getFormattedValue();
            }

            if (array_filter($rowData)) {
                $rows[] = $rowData;

                if (count($rows) >= $chunkSize) {
                    ParseExcelRowsJob::dispatch($rows, $uniqueKey);
                    $rows = [];
                }

                $processedRows++;
                Redis::command("SET", [$uniqueKey, $processedRows]);
            }
        }

        if (count($rows) > 0) {
            ParseExcelRowsJob::dispatch($rows, $uniqueKey);
        }
    }
}
