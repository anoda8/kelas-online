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
                            <div class="col-md-6">
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
                            </div>
                            <div class="col-md-6">
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
                        </div>
                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input type="text" class="form-control" wire:model.lazy="judTugas">
                            @error('judTugas') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <div wire:ignore>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" wire:model.lazy="deskripsi" rows="7"></textarea>
                            </div>
                        </div>
                        @error('deskripsi') <span class="text-danger error">{{ $message }}</span>@enderror
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
                    <div class="card-footer">
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn btn-success" wire:click="$emit('triggerSimpan')"><i class="fas fa-save"></i> Simpan</button>
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
    @this.on('toggleAddForm', () => {
        // @this.call('clearForm');
        // CKEDITOR.instances['isimateri'].setData('');
        $('#collapseTambah').collapse('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerSimpan', () => {
        var deskripsi = CKEDITOR.instances['deskripsi'].getData();
        @this.set('deskripsi', deskripsi);
        @this.call('simpan');
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
});
CKEDITOR.replace( 'deskripsi' );
</script>
@endsection
