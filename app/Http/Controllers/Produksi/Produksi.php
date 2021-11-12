<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\mLokasi;
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
            ["data" => "menu"],
        ];

        return view('produksi.produksiList', [
            'title' => "Data Produksi",
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
            $no = $key + $start;

            $nestedData['no'] = $no;
            $nestedData['kode_produksi'] = $row->kode_produksi;
            $nestedData['lokasi'] = $row->lokasi->lokasi;
            $nestedData['tanggal_mulai'] = $row->tgl_mulai_produksi;
            $nestedData['tanggal_selesai'] = $row->tgl_selesai_produksi;
            $nestedData['status'] = $row->status;
            $nestedData['publish'] = $row->publish;
            $nestedData['menu'] = '
                <div class="btn btn-group m-btn-group" role="group" aria-label="...">
                    <a href="' . route('editProduksi', ['id' => $row->id]) . '" class="btn btn-success">Edit</a>
                    <button href="' . route('deleteProduksi', ['id' => $row->id]) . '" class="btn btn-danger btn-hapus" data-route="">Hapus</button>
                </div>
            ';

            $data[] = $nestedData;
        }

        $json_data = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($total_data - 1),
            "recordsFiltered" => intval($total_data - 1),
            "data" => $data,
            "all_request" => $request->all(),
        ];
        return $json_data;
    }

    public function create()
    {
        $lokasi = mLokasi::all();
        return view('produksi.createProduksi', [
            'title' => 'Tambah Produksi',
            'lokasi' => $lokasi,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produksi' => ['required'],
            'id_lokasi' => ['required'],
            'tgl_mulai_produksi' => ['required'],
            'tgl_selesai_produksi' => ['required'],
        ]);

        mProduksi::create([
            'kode_produksi' => $request->kode_produksi,
            'tgl_mulai_produksi' =>  date('Y-m-d', strtotime($request->tgl_mulai_produksi)),
            'tgl_selesai_produksi' =>  date('Y-m-d', strtotime($request->tgl_selesai_produksi)),
            'id_lokasi' =>  $request->id_lokasi,
            'catatan' =>  $request->catatan,
        ]);
    }

    public function edit($id)
    {
        return view('produksi.editProduksi', [
            'title' => 'Edit Data Produksi',
            'lokasi' => mLokasi::all(),
            'produksi' => mProduksi::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produksi' => ['required'],
            'id_lokasi' => ['required'],
            'tgl_mulai_produksi' => ['required'],
            'tgl_selesai_produksi' => ['required'],
        ]);

        $data_update = [
            'kode_produksi' => $request->kode_produksi,
            'tgl_mulai_produksi' =>  date('Y-m-d', strtotime($request->tgl_mulai_produksi)),
            'tgl_selesai_produksi' =>  date('Y-m-d', strtotime($request->tgl_selesai_produksi)),
            'id_lokasi' =>  $request->id_lokasi,
            'catatan' =>  $request->catatan,
        ];

        mProduksi::find($id)->update($data_update);
    }

    public function destroy($id)
    {
        mProduksi::find($id)->delete();
    }
}
