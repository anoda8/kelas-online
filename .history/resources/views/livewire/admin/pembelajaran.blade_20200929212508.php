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
                        Tambah {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        {{-- <a type="button" class="mr-2 btn btn-warning btn-sm" wire:click="$emit('showImportForm')" />
                            <i class="fas fa-download"></i> Impor
                        </a>
                        <a type="button" class="mr-2 btn btn-success btn-sm" href="{{ '/'.request()->path().'/export' }}" />
                            <i class="fas fa-download"></i> Ekspor
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                            <i class="fas fa-plus"></i> Tambah
                        </button> --}}
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group" wire:ignore>
                                <label for="" style="font-weight: bold;">Mata Pelajaran</label>
                                <select class="form-control pilih-mapel" wire:model="mapel">
                                    <option value="" selected>== Pilih Mata Pelajaran ==</option>
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}" wire:click="pilihMapel({{ $mapel->id }})">{{ $mapel->nama }} - {{ $mapel->guru->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" style="font-weight: bold;">Diajarkan Di Kelas</label><br>
                            @foreach ($kelases as $kelas)
                                <button class="btn {{ array_search($kelas->id, $kelasid, true) ? "btn-danger" : "btn-dark" }} ml-2 mr-2 mb-2 mt-2" wire:click="collectKelas({{ $kelas->id }})">{{ $kelas->nama }}</button>
                            @endforeach
                        </div>
                        {{ $kelasid }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-actions-pane-right text-capitalize">
                        <button class="btn btn-primary" wire:click="simpan()"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-tab card-header">
                        {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <div class="form-inline"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mapel</th>
                                    <th class="text-center">Guru</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Author</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembelajarans as $index => $pembl)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $pembl->mapel->nama }}</td>
                                    <td>{{ $pembl->mapel->guru->nama }}</td>
                                    <td class="text-center">{{ $pembl->kelas->nama }}</td>
                                    <td class="text-center">{{ $pembl->author->name }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('triggerDelete', {{ $pembl->id }})"><i class="fas fa-trash fa-sm"></i></a>
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
</div>
@section('scripts')
<script>
$(document).ready(function () {
    $(".pilih-mapel").select2();
    $(".pilih-mapel").on('change', function(e){
        @this.call('pilihMapel', e.target.value);
    })
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
