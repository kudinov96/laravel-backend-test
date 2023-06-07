<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelRequest;

class ExcelUploadController extends Controller
{
    public function index()
    {
        return view("excel");
    }

    public function upload(ExcelRequest $request)
    {
        $excel = $request->excel;
    }
}
