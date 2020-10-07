<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                <a href="{{ route('siswa.tugas') }}" data-toggle="tooltip" title="Kembali" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-header text-capitalize">
                    [{{ $tugas->mapel->nama }}] {{ $tugas->judul }}
                </div>
                <div class="card-body">
                    {!! $tugas->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-capitalize">
                    Respon Tugas
                    <div class="btn-actions-pane-right">
                        <button class="btn btn-primary" wire:click="edit({{ $respon->first()->id }})"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</button>
                    </div>
                </div>
                <div class="card-body">
                    @if (($respon->count() > 0) && ($modeEdit == false))
                        {!! $respon->first()->jawaban !!}
                        <a href="/{{ $respon->first()->file }}">Download</a>
                    @else
                        <div class="form-group">
                            <label for="">Isi Respon Tugas</label>
                            <div wire:ignore>
                                <textarea class="form-control" id="jawaban" name="jawaban" wire:model.lazy="jawaban" rows="3"></textarea>
                            </div>
                        </div>
                        @error('jawaban') <span class="error">{{ $message }}</span> @enderror
                        <label for="">Lampirkan File</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" wire:model="fileimport" class="custom-file-input">
                                <label class="custom-file-label" for="inputGroupFile01">{{ $fileimport ? $fileimport->getClientOriginalName() : "Pilih Dokumen" }}</label>
                            </div>
                        </div>
                        @error('fileimport') <span class="error">{{ $message }}</span> @enderror
                        @if (($respon->count() > 0) && ($modeEdit == false))
                            {{ end(explode('/', $respon->file)) }}
                        @endif
                    @endif
                </div>
                <div class="card-footer">
                    <div class="btn-actions-pane-right">
                        <button class="btn btn-success" wire:click="$emit('triggerSimpan')">Simpan</button>
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
    @this.on('triggerSimpan', () => {
        var jawaban = CKEDITOR.instances['jawaban'].getData();
        @this.set('jawaban', jawaban);
        @this.call('simpan');
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
});
CKEDITOR.replace('jawaban');
</script>
@endsection
