@extends('layouts.base')

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Edit Data Produksi
            </h3>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<!--begin: Datatable -->
<div class="m-content">
    <div class="m-portlet akses-list">
        <div class="m-portlet__body">
            <form action="{{ route('editProduksi', ['id'=>$produksi->id]) }}" data-redirect="{{route('produksi')}}"
                class="form-send m-form" method="POST">
                @csrf
                @method('put')
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Kode Produksi
                                </label>
                                <input type="text" value="{{ (old('kode_produksi')) ?? $produksi->kode_produksi }}"
                                    name="kode_produksi" class="form-control m-input" autofocus
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
                                    @if ($produksi->id_lokasi == $item->id)
                                    <option selected value="{{ $item->id }}">{{ $item->kode_lokasi. " - ".
                                        $item->lokasi}}
                                    </option>
                                    @else
                                    <option value="{{ $item->id }}">{{ $item->kode_lokasi. " - ". $item->lokasi}}
                                    </option>
                                    @endif
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
                                <input type="date"
                                    value="{{ (old('tgl_mulai_produksi')) ?? $produksi->tgl_mulai_produksi }}"
                                    name="tgl_mulai_produksi" class="form-control m-input" placeholder="Mulai Produksi">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Selesai Produksi
                                </label>
                                <input type="date"
                                    value="{{ (old('tgl_selesai_produksi')) ?? $produksi->tgl_selesai_produksi }}"
                                    name="tgl_selesai_produksi" class="form-control m-input"
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
                                <textarea name="catatan" value="{{ (old('catatan')) ?? $produksi->catatan }}"
                                    class="form-control m-input" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <button type="submit" class="btn btn-warning">
                            Edit Data Produksi
                        </button>
                        <a href="{{ route('produksi') }}" class="btn btn-primary">Kembali ke List</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end: Datatable -->
@endsection