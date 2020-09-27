<div>
    @include('layouts.header')
    @include('layouts.menu')
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
            <div class="mb-5 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tabel {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <div class="form-inline">
                            <div class="form-group mr-3 input-group-sm">
                              <input type="text" class="form-control" wire:model="katakunci" placeholder="Cari nama">
                            </div>
                            <a type="button" class="mr-2 btn btn-warning btn-sm" wire:click="$emit('showImportForm')" />
                                <i class="fas fa-download"></i> Impor
                            </a>
                            <a type="button" class="mr-2 btn btn-success btn-sm" href="{{ '/'.request()->path().'/export' }}" />
                                <i class="fas fa-download"></i> Ekspor
                            </a>
                            <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <div class="modal fade" id="modal-kelas" tabindex="-1" role="dialog" aria-labelledby="modalKelas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form {{ $this->heading['judul'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Nama Kelas</label>
                      <input type="text" wire:model.lazy="nama" class="form-control" aria-describedby="namaKelas" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <select class="form-control" wire:model.lazy="jurusan">
                            <option value="">== Pilih Jurusan ==</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->tingkat }} - {{ $jurusan->singkat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
window.livewire.on('closeAddForm', () => {
    $('#modal-kelas').modal('hide');
    $('.modal-backdrop').each(function(){
        $(this).remove();
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        $('#modal-kelas').modal('toggle');
    });
});
</script>
@endsection
