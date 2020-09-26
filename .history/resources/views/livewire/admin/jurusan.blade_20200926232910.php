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
                        <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Singkat</th>
                                    <th class="text-center">Tingkat</th>
                                    <th class="text-center">Dibuat Tanggal</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusans as $index => $jurusan)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $jurusan->nama }}</td>
                                    <td class="text-center">{{ $jurusan->singkat }}</td>
                                    <td class="text-center">{{ $jurusan->tingkat }}</td>
                                    <td class="text-center">{{ $jurusan->created_at }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('triggerDelete', {{ $guru->id }})"><i class="fas fa-trash fa-sm"></i></a>
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
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal-jurusan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form {{$this->heading['judul']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Jurusan</label>
                        <input type="text" wire:model.lazy="nama" class="form-control" placeholder="Contoh : Matematika & Ilmu Pengetahuan Alam">
                        @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Singkat</label>
                        <input type="text" wire:model.lazy="singkat" class="form-control" placeholder="Contoh : MIPA">
                        @error('singkat') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tingkat</label>
                        <select class="form-control" wire:model.lazy="tingkat">
                            <option value="">== Pilih Tingkat ==</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('tingkat') <span class="text-danger error">{{ $message }}</span>@enderror
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
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        $('#modal-jurusan').modal('toggle');
    });
});
window.livewire.on('closeAddForm', () => {
    $('#modal-jurusan').modal('hide');
    $('.modal-backdrop').each(function(){
        $(this).remove();
    });
});
</script>
@endsection
