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
            <div class="mb-2 card">
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
                                            <option value="{{ $pembl->kelas->id }}">{{ $pembl->kelas->nama }}</option>
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
                                        <textarea class="form-control" id="isimateri" name="isimateri" wire:model.lazy="isimateri" rows="7"></textarea>
                                    </div>
                                </div>
                                @error('isimateri') <span class="text-danger error">{{ $message }}</span>@enderror
                                <div class="form-group">
                                    <label for="">Link Youtube</label>
                                    <input type="text" class="form-control" wire:model.lazy="videopath">
                                </div>
                                <label for="">Lampirkan File</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" wire:model="dokumen" class="custom-file-input">
                                        <label class="custom-file-label" for="inputGroupFile01">{{ $dokumen ? $dokumen->getClientOriginalName() : "Pilih Dokumen" }}</label>
                                    </div>
                                </div>
                                <small id="helpId" class="form-text text-muted">(PDF, Excel, Word, PowerPoint)</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn btn-success" wire:click="$emit('triggerSimpan')"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <div class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mr-2" placeholder="Cari materi" wire:model="kataKunciMateri">
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
            @foreach ($kelons as $kelon)
            <div class="mb-2 card">
                <div class="card-header">
                    {{ $kelon->materi }}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Mulai Tanggal / Pukul <br>
                            <span class="font-weight-bold">{{ date("d-m-Y / H:i", strtotime($kelon->wkt_masuk)) }} WIB</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Sampai Tanggal / Pukul <br>
                            <span class="font-weight-bold">{{ date("d-m-Y / H:i", strtotime($kelon->wkt_selesai)) }} WIB</span>
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
                    <span class="font-weight-bold text-danger">{{ $kelon->kelas->nama }}</span>
                    <div class="btn-actions-pane-right">
                        <div class="form-inline">
                            <button class="btn btn-danger ml-2" wire:click="$emit('triggerHapus', {{ $kelon->id }})"><i class="fas fa-trash"></i> Hapus</button>
                            <button class="btn btn-info ml-2" wire:click="$emit('triggerEdit', {{ $kelon->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                            <button class="btn btn-warning ml-2"><i class="fas fa-print"></i> Laporan</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
        @this.call('clearForm');
        CKEDITOR.instances['isimateri'].setData('');
        $('#collapseTambah').collapse('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerEdit', orderId => {
        @this.call('edit', orderId);
        $('#collapseTambah').collapse('show');
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerHapus', orderId => {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah anda yakin akan menghapusnya ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: 'var(--success)',
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'Hapus !'
        }).then((result) => {
            if(result.value){
                @this.call('hapus', orderId);
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('isiMateri', text => {
        @this.set('isimateri', text);
        CKEDITOR.instances['isimateri'].setData(text);
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerSimpan', () => {
        var isimateri = CKEDITOR.instances['isimateri'].getData();
        @this.set('isimateri', isimateri);
        @this.call('simpan');
    });
});
CKEDITOR.replace( 'isimateri' );
</script>
@endsection
