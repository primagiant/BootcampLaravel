@extends('layouts.base')

@section('content')
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
                                    required name="kode_produksi" class="form-control m-input" autofocus
                                    placeholder="Masukkan kode Produksi">
                                <span class="m-form__help">
                                    Masukkan kode Produksi
                                </span>
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
                                <span class="m-form__help">
                                    Lokasi Pabrik
                                </span>
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
                                    name="tgl_mulai_produksi" required class="form-control m-input"
                                    placeholder="Mulai Produksi">
                                <span class="m-form__help">
                                    Mulai Produksi
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group">
                                <label>
                                    Selesai Produksi
                                </label>
                                <input type="date"
                                    value="{{ (old('tgl_selesai_produksi')) ?? $produksi->tgl_selesai_produksi }}"
                                    name="tgl_selesai_produksi" required class="form-control m-input"
                                    placeholder="Selesai Produksi">
                                <span class="m-form__help">
                                    Selesai Produksi
                                </span>
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
                                <span class="m-form__help">
                                    Deskripsi Catatan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <button type="submit" class="btn btn-warning">
                            Edit Data Produksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end: Datatable -->
@endsection