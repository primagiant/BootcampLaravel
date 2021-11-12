@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<!--begin: Datatable -->
<div class="m-content">
    <div class="m-portlet akses-list">
        <div class="m-portlet__body">
            <div class="table-responsive">
                <a href="{{ route('tambahProduksi') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <table class="akses-list table table-bordered datatable" id="datatable-new"
                    data-url="{{ route('produksiDatatable') }}" data-column="{{json_encode($datatable_column)}}">
                    <thead>
                        <th width="20">No</th>
                        <th class="no-sort">Kode Produksi</th>
                        <th class="no-sort">Lokasi</th>
                        <th class="no-sort">Tanggal Mulai</th>
                        <th class="no-sort">Tanggal Selesai</th>
                        <th class="no-sort">Status</th>
                        <th class="no-sort">Publish</th>
                        <th class="no-sort">Menu</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end: Datatable -->
@endsection