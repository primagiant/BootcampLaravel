@extends('layouts.base')

@section('content')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Tambah Data Produksi
            </h3>
        </div>
    </div>
</div>

<form action="{{ route('tambahProduksi') }}" data-redirect="{{route('produksi')}}" class="form-send m-form"
    method="POST">
    @csrf
    <div class="m-content">
        <div class="m-portlet akses-list">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-placeholder-2"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Data Produksi
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Kode Produksi
                                </label>
                                <input type="text" name="kode_produksi" class="form-control m-input" autofocus
                                    placeholder="Masukkan kode Produksi">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Pabrik
                                </label>
                                <select name="id_lokasi" class="form-control m-input">
                                    @foreach ($lokasi as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode_lokasi. " - ". $item->lokasi}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Mulai Produksi
                                </label>
                                <input type="date" name="tgl_mulai_produksi" class="form-control m-input"
                                    placeholder="Mulai Produksi">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Selesai Produksi
                                </label>
                                <input type="date" name="tgl_selesai_produksi" class="form-control m-input"
                                    placeholder="Selesai Produksi">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Catatan
                                </label>
                                <textarea name="catatan" class="form-control m-input" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet akses-list">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-placeholder-2"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Pilih Produk
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-portlet__body">
                    <table class="table table-bordered table-striped table-produk">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Qty Produksi</th>
                                <th>Keteragan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="m-portlet akses-list">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-placeholder-2"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Daftar Bahan
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body data-bahan-view"></div>
        </div>

        <div class="m-portlet akses-list">
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <button type="submit" class="btn btn-success">
                        Tambah Produksi
                    </button>
                    <a href="{{ route('produksi') }}" class="btn btn-primary">Kembali ke List</a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="m--hide">
    <table class="table-produk-row">
        <tbody>
            <tr>
                <td class="produk">
                    <select class="form-control" name="id_produk">
                        {{-- @foreach($produk as $row) --}}
                        {{-- <option value="{{ $row->id }}">{{ $row->nama_produk }}</option> --}}
                        {{-- @endforeach --}}
                    </select>
                </td>
                <td class="qty">
                    <input type="number" class="form-control" name="qty_produksi" value="0">
                </td>
                <td>
                    <textarea name="keterangan" class="form-control"></textarea>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-produk-hapus">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection