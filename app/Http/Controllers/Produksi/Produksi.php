<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\mProduksi;
use Illuminate\Http\Request;

class Produksi extends Controller
{
    public function index()
    {
        $datatable_column = [
            ["data" => "no"],
            ["data" => "kode_produksi"],
            ["data" => "lokasi"],
            ["data" => "tanggal_mulai"],
            ["data" => "tanggal_selesai"],
            ["data" => "status"],
            ["data" => "publish"],
            ["data" => "options"],
        ];
        return view('produksi.produksiList', [
            'datatable_column' => $datatable_column,
        ]);
    }
    public function datatable(Request $request)
    {
        $total_data = mProduksi::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order_column = 'id';
        $order_type = $request->input('order.0.dir');

        $data_list = mProduksi::with(['lokasi'])
            ->offset($start)
            ->limit($limit)
            ->orderBy($order_column, $order_type)
            ->get();

        $total_data++;
        $data = [];

        foreach ($data_list as $key => $row) {
            $key++;
            if ($order_type == "asc") {
                $no = $key + $start;
            } else {
                $no = $total_data - $key - $start;
            }

            $nestedData['no'] = $no;
            $nestedData['kode_produksi'] = $row->kode_produksi;
            $nestedData['lokasi'] = $row->lokasi->lokasi;
            $nestedData['tanggal_mulai'] = $row->tgl_mulai_produksi;
            $nestedData['tanggal_selesai'] = $row->tgl_selesai_produksi;
            $nestedData['status'] = $row->status;
            $nestedData['publish'] = $row->publish;

            $data[] = $nestedData;
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordTotal" => intval($total_data - 1),
            "recordFiltered" => intval($total_data - 1),
            "data" => $data,
            "all_request" => $request->all(),
        ];
        return $json_data;
    }
}
