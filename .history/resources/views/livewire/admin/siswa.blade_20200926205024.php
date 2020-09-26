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
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $index => $siswa)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td class="text-center">{{ $siswa->kelas }}</td>
                                    <td class="text-center">{{ $siswa->tgl_lahir }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info btn-sm" wire:click.prevent="$emit('triggerEdit', {{ $siswa->id }})"><i class="fas fa-pencil-alt fa-sm"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('triggerDelete', {{ $siswa->id }})"><i class="fas fa-trash fa-sm"></i></a>
                                    </td>
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
                        <input type="text" class="form-control" wire:model.lazy="nama">
                        @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                       <label for="">NIS</label>
                       <input type="text" class="form-control" wire:model.lazy="nis">
                       @error('nis') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select class="form-control" style="width:100%;" wire:model.lazy="jenkel">
                            <option value="">== Pilih Jenis Kelamin ==</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenkel') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" wire:model.lazy="tgl_lahir">
                        @error('tgl_lahir') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="simpan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="import-siswa" tabindex="-1" role="dialog" aria-labelledby="modalGuru" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Import {{$this->heading['judul']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" wire:model="fileimport" class="custom-file-input">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('fileimport') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" wire:click.prevent="import" class="btn btn-sm btn-primary">Impor</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
window.livewire.on('closeAddForm', () => {
    $('#modal-siswa').modal('hide');
    $('.modal-backdrop').each(function(){
        $(this).remove();
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        $('#modal-siswa').modal('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerEdit', orderId => {
        @this.call('edit', orderId);
        $('#modal-siswa').modal('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerDelete', orderId => {
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
</script>
@endsection
