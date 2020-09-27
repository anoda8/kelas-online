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
                            <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kelas</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Author</th>
                                <th class="text-center">Jumlah Siswa</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelases as $index => $kelas)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $kelas->nama }}</td>
                                <td class="text-center">{{ $kelas->jurusan->tingkat }} - {{ $kelas->jurusan->singkat }}</td>
                                <td class="text-center">{{ $kelas->author->name }}</td>
                                <td class="text-center">{{ $kelas->siswa->count() }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-info btn-sm" wire:click.prevent="$emit('triggerDetail', {{ $kelas->id }})"><i class="fas fa-search fa-sm"></i>&nbsp;Detail</a>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('triggerDelete', {{ $kelas->id }})"><i class="fas fa-trash fa-sm"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <div class="modal fade" wire:ignore.self id="modal-kelas" tabindex="-1" role="dialog" aria-labelledby="modalKelas" aria-hidden="true">
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
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal-detail-kelas" tabindex="-1" role="dialog" aria-labelledby="modalDetailKelas" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kelas {{ $detailKelasNama ?? "-" }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                              <label for="">Cari Siswa</label>
                              <input type="text" class="ml-3 form-control" wire:model="cariNama" placeholder="Nama Siswa">
                              <input type="text" class="ml-3 form-control" wire:model="cariNis" placeholder="NIS">
                            </div>
                            <ul class="list-group">
                                @foreach ($carisiswa as $siswa)
                                    <li class="list-group-item" wire:click="tambahkanSiswa({{ $siswa->id }})" style="cursor:pointer;background-color:lightgreen;"><b>{{ $siswa->nis }} || {{ $siswa->nama }}</b> => <i>[{{ $siswa->jenkel ? "Perempuan" : "Laki-laki" }}, {{ $siswa->tgl_lahir }}]</i></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                                <h5 class="modal-title ml-7">Daftar Siswa Kelas {{ $detailKelasNama ?? "-" }}</h5><br>
                                <a class="btn btn-success btn-sm ml-5" href="/admin/data/kelas/export/{{ $detailKelasId }}"><i class="fas fa-file-excel"></i>&nbsp;&nbsp;&nbsp;Expor</a>
                            </div>
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIS</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tgl Lahir</th>
                                        <th class="text-center">Hapus </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $index => $siswa)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td class="text-center">{{ $siswa->jenkel }}</td>
                                        <td class="text-center">{{ $siswa->tgl_lahir }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('triggerHapusSiswa', {{ $siswa->id }})"><i class="fas fa-trash fa-sm"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerDetail', orderId => {
        @this.call('detailKelas', orderId);
        $('#modal-detail-kelas').modal('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerHapusSiswa', orderId => {
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
                @this.call('hapusSiswa', orderId);
            }
        });
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
