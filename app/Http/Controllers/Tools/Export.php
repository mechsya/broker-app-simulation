<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Trade;
use App\Models\Transfer;
use App\Models\Withdraw;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Controller
{
    private function getUserRelatedData($modelName, $user)
    {
        return match ($modelName) {
            'withdraw' =>  Withdraw::where('user_id', Cookie::get('id'))->orderBy('id', 'DESC')->get(),
            'profit-fund' => Investment::with('package')->where('user_id', Cookie::get('id'))->where('expiresAt', ">=", now())->get(),
            'transfer-history' => Transfer::with('recipiente')->where('sender', Cookie::get('id'))->get(),
            'trade-history' => Trade::where('user_id', Cookie::get('id'))->get(),
            default    => collect(),
        };
    }

    public function export(Request $request)
    {
        $type = $request->input('type');
        $model = $request->input('model');

        $data = $this->getUserRelatedData($model, Cookie::get('id'));

        if (count($data) === 0) {
            return response()->json(['message' => 'No data to export'], 204);
        }

        if ($type === 'excel') {
            return Excel::download(new \App\Http\Controllers\Tools\GenericExport($data), "$model.xlsx");
        }

        if ($type === 'csv') {
            return Excel::download(new \App\Http\Controllers\Tools\GenericExport($data), "$model.csv", \Maatwebsite\Excel\Excel::CSV);
        }

        if ($type === 'pdf') {
            $pdf = Pdf::loadView('pdf.generic', compact('data', 'model'));
            return $pdf->download("$model.pdf");
        }
    }
}
