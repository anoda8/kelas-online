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
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <div class="modal fade" wire:ignore.self id="modal-siswa" tabindex="-1" role="dialog" aria-labelledby="modalGuru" aria-hidden="true">
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
                      <label for="">Nama Lengkap</label>
                      <input type="text" class="form-control" wire:model.lazy="nama" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="simpan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        // @this.call('clearFormUser');
        $('#modal-siswa').modal('toggle');
    });
});
</script>
@endsection
