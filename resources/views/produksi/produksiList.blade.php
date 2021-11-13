@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Produksi List
            </h3>
        </div>
        <a href="{{ route('tambahProduksi') }}" class="btn btn-primary mb-3">
            Tambah Data
        </a>
    </div>
</div>
<!-- END: Subheader -->
<!--begin: Datatable -->
<div class="m-content">
    <div class="m-portlet akses-list">
        <div class="m-portlet__body">
            <div class="table-responsive">
                <table class="akses-list table table-bordered datatable" id="datatable-new"
                    data-url="{{ route('produksiDatatable') }}" data-column="{{json_encode($datatable_column)}}">
                    <thead>
                        <th width="20">No</th>
                        <th class="no-sort text-center">Kode Produksi</th>
                        <th class="no-sort text-center">Lokasi</th>
                        <th class="no-sort text-center">Tanggal Mulai</th>
                        <th class="no-sort text-center">Tanggal Selesai</th>
                        <th class="no-sort text-center">Status</th>
                        <th class="no-sort text-center">Publish</th>
                        <th class="no-sort text-center">Menu</th>
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