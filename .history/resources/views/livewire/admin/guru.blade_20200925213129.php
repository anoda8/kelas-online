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
                        <a type="button" class="btn btn-success btn-sm" href="/admin/users/export/" />
                            <i class="fas fa-download"></i> Export
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Dibuat Tanggal</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $index => $guru)
                                <tr>
                                    <td></td>
                                    <td>{{ $guru->nama }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal-guru" tabindex="-1" role="dialog" aria-labelledby="modalGuru" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="namaLengkap">Nama Lengkap</label>
                      <input type="text" wire:model.lazy="nama" id="namaLengkap" class="form-control" placeholder="">
                      @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="namaLengkap">NIP (Nomor Induk Pegawai)</label>
                        <input type="text" wire:model.lazy="nip" id="namaLengkap" class="form-control" placeholder="">
                        @error('nip') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="namaLengkap">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" wire:model.lazy="nik" id="namaLengkap" class="form-control" placeholder="">
                        @error('nik') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <hr>
                    <div class="form-check">
                      <label class="form-check-label" style="cursor: pointer;font-weight:bold;">
                        <input type="checkbox" class="form-check-input" wire:model.lazy="buatUser" value="checkedValue" checked>
                        Buat User
                      </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    @if($modeEdit == true)
                        <button type="button" class="btn btn-sm btn-primary" wire:click="edit()">Simpan</button>
                    @else
                        <button type="button" class="btn btn-sm btn-primary" wire:click="simpan()">Simpan</button>
                    @endif
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
        $('#modal-guru').modal('toggle');
    });
});
</script>
@endsection
