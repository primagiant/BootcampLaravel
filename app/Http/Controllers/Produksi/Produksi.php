<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\mBahan;
use App\Models\mBahanProduksi;
use App\Models\mDetailProduksi;
use App\Models\mKomposisiProduk;
use App\Models\mLokasi;
use App\Models\mProduk;
use App\Models\mProduksi;
use App\Models\mStokBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    <button class="btn btn-danger btn-hapus" data-route="' . route('deleteProduksi', ['id' => $row->id]) . '">Hapus</button>
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
        $produk = mProduk::all();
        return view('produksi.createProduksi', [
            'lokasi' => $lokasi,
            'produk' => $produk,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produksi' => ['required'],
            'id_lokasi' => ['required'],
            'tgl_mulai_produksi' => ['required'],
            'tgl_selesai_produksi' => ['required'],
            'catatan' => ['required'],
            'id_produk' => ['required'],
            'id_produk.*' => ['required'],
            'qty_digunakan' => ['required'],
            'qty_digunakan.*' => ['required'],
        ]);

        $id_produk_arr = $request->id_produk;
        $qty_produksi_arr = $request->qty_produksi;
        $keterangan_arr = $request->keterangan;
        $qty_digunakan_arr = $request->qty_digunakan;
        $month = date('m', strtotime($request->tgl_mulai_produksi));
        $year = date('Y', strtotime($request->tgl_mulai_produksi));
        $date_modified = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            $id_produksi = mProduksi::create([
                'kode_produksi' => $request->kode_produksi,
                'tgl_mulai_produksi' =>  date('Y-m-d', strtotime($request->tgl_mulai_produksi)),
                'tgl_selesai_produksi' =>  date('Y-m-d', strtotime($request->tgl_selesai_produksi)),
                'id_lokasi' =>  $request->id_lokasi,
                'catatan' =>  $request->catatan,
            ])->id;

            $data_detail_produksi = [];
            foreach ($id_produk_arr as $key => $id_produk) {
                $qty_produksi = $qty_produksi_arr[$key];
                $keterangan = $keterangan_arr[$key];
                $data_detail_produksi[] = [
                    'id_produksi' => $id_produksi,
                    'id_produk' => $id_produk,
                    'month' => $month,
                    'year' => $year,
                    'qty' => $qty_produksi,
                    'keterangan' => $keterangan,
                    'created_at' => $date_modified,
                    'updated_at' => $date_modified,
                ];
            }

            mDetailProduksi::insert($data_detail_produksi);

            $data_bahan_produksi = [];
            foreach ($qty_digunakan_arr as $key => $id_stok_bahan_arr) {
                foreach ($id_stok_bahan_arr as $id_stok_bahan => $qty_digunakan) {
                    $id_bahan = mStokBahan::where('id', $id_stok_bahan)->value('id_bahan');
                    $id_bahan = $id_bahan ? $id_bahan : 0;

                    $id_satuan = mBahan::where('id', $id_bahan)->value('id_satuan');
                    $id_satuan = $id_satuan ? $id_satuan : 0;

                    $id_lokasi = mStokBahan::where('id', $id_stok_bahan)->value('id_lokasi');
                    if($id_lokasi) {
                        $lokasi = mLokasi::where('id', $id_lokasi)->first();
                        $gudang_qty = $lokasi['lokasi']; 
                    } else {
                        $gudang_qty = '';
                    }

                    $qty = mStokBahan::where('id', $id_stok_bahan)->value('qty');
                    $qty = $qty ? $qty : 0;

                    $data_bahan_produksi[] = [
                        'id_produksi' => $id_produksi,
                        'id_bahan' => $id_bahan,
                        'id_satuan' => $id_satuan,
                        'qty_diperlukan' => $qty_digunakan,
                        'gudang_qty' => $gudang_qty,
                        'qty' => $qty,
                        'created_at' => $date_modified,
                        'updated_at' => $date_modified
                    ];
                }
                mBahanProduksi::insert($data_bahan_produksi);

                DB::commit();
            }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        return view('produksi.editProduksi', [
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

    function bahan_list(Request $request)
    {
        $id_produk = $request->input('id_produk');
        $qty_produksi = $request->input('qty_produksi');

        $komposisi_produk = mKomposisiProduk
            ::select([
                'tb_bahan.*',
                'tb_komposisi_produk.*',
                'tb_komposisi_produk.qty AS komposisi_qty'
            ])
            ->leftJoin('tb_bahan', 'tb_bahan.id', '=', 'tb_komposisi_produk.id_bahan')
            ->where('tb_komposisi_produk.id_produk', $id_produk)
            ->orderBy('nama_bahan', 'ASC')
            ->get();

        $data = [
            'qty_produksi' => $qty_produksi,
            'komposisi_produk' => $komposisi_produk
        ];

        return view('produksi.produksiBahanList', $data);
    }

}
