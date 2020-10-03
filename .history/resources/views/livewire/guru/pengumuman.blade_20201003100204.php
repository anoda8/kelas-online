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
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Judul Pengumuman</label>
                                  <input type="text" class="form-control" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option value="">-- Pilih Tujuan Pengumuman --</option>
                                            <option value="all">Semua Warga Sekolah</option>
                                            <option value="guru">Semua Guru</option>
                                            <option value="siswa">Semua Siswa</option>
                                        </select>
                                    </div>
                                    <div class="form-group ml-3">
                                        <select class="form-control">
                                            <option value="">-- Kelas --</option>
                                            @foreach ($kelases as $kelas)
                                                <option value="{{ $kelas->id }}">$kelas->nama</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><hr>
                                <textarea name="isi_pengumuman" id="isi-pengumuman" rows="10"></textarea>
                            </div>
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
        CKEDITOR.instances['isi-pengumuman'].setData('');
        $('#collapseTambah').collapse('toggle');
    });
});
CKEDITOR.replace( 'isi-pengumuman' );
</script>
@endsection
