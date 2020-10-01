<div>
    @include('layouts.header')
    @include('layouts.menu_guru')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tambah {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <button class="btn btn-primary" wire:click="$emit('toggleAddForm')"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>
                <div wire:ignore.self class="collapse" id="collapseTambah">
                    <div class="pt-3 card-body">
                        <div class="row">
                            <div class="col-md-5 col-lg-5 col-sm-12">
                                <div class="form-group">
                                    <label for="">Tanggal Pembelajaran</label>
                                    <input type="date" class="form-control" wire:model.lazy="tgl_kelon">
                                    @error('tgl_kelon') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select class="form-control" wire:model="mapelid">
                                        <option value="" >== Pilih Mapel ==</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('mapelid') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select class="form-control" wire:model="kelasid">
                                        <option value="" selected>== Pilih Kelas ==</option>
                                        @foreach ($pembelajaran as $pembl)
                                            <option>{{ $pembl->kelas->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelasid') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-12">
                                <div class="form-group">
                                    <label for="">Waktu Mulai</label>
                                    <input type="time" class="form-control" wire:model="wktmulai">
                                </div>
                                @error('wktmulai') <span class="text-danger error">{{ $message }}</span>@enderror
                                <div class="form-group">
                                    <label for="">Waktu Selesai</label>
                                    <input type="time" class="form-control" wire:model="wktselesai">
                                </div>
                                @error('wktselesai') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="">Judul Materi</label>
                                <input type="text" class="form-control" wire:model.lazy="materi">
                                </div>
                                @error('materi') <span class="text-danger error">{{ $message }}</span>@enderror
                                <div class="form-group">
                                <label for="">Isi Materi</label>
                                <div wire:ignore>
                                <textarea class="form-control" id="isimateri" wire:model.lazy="isimateri" rows="7"></textarea>
                                </div>
                                </div>
                                @error('isimateri') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn btn-success" wire:click="$emit('saveForm')"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <div class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mr-2" aria-describedby="helpId" placeholder="">
                                <input type="text" class="form-control form-control-sm mr-2" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5 card">
                <div class="card-header">
                    Jurnal Penutup dan Jurnal Pembalik

                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Tanggal <br>
                            <span class="font-weight-bold">12 Maret 2020</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Waktu  <br>
                            <span class="font-weight-bold">07:00 s/d 09:00</span>

                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Hadir <br>
                            <span class="font-weight-bold">30 Anak</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Tidak Masuk <br>
                            <span class="font-weight-bold">6 Anak</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="font-weight-bold text-danger">XII MIPA 5</span>
                    <div class="btn-actions-pane-right">
                        <div class="form-inline">
                            <button class="btn btn-warning ml-2">Detail</button>
                            <button class="btn btn-warning ml-2">Edit</button>
                            <button class="btn btn-warning ml-2">Laporan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('saveForm', () => {
        @this.call('simpan');
        // $('#collapseTambah').collapse('hide');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('closeAddForm', () => {
        $('#collapseTambah').collapse('hide');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('toggleAddForm', () => {
        $('#collapseTambah').collapse('toggle');
    });
});
CKEDITOR.replace( 'isimateri' );
</script>
@endsection
