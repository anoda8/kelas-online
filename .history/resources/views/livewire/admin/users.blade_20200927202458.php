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
                        <a type="button" class="btn btn-success btn-sm" href="/admin/users/export/{{ $level }}" />
                            <i class="fas fa-download"></i> Export
                        </a>

                        @if ($level == 'admin')
                        <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                        @endif

                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Dibuat Tanggal</th>
                                <th class="text-center">Login Terakhir</th>
                                <th class="text-center">{{ $level == 'admin' ? "Edit" : "Reset" }}</th>
                                <th class="text-center">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td scope="row" class="text-center">{{ ($index + 1) + (($users->currentPage() - 1) * $users->perPage()) }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">
                                    @if ($level == 'admin')
                                        <a href="#" class="btn btn-info btn-sm" wire:click.prevent="$emit('userTriggerEdit', {{ $user->id }})"><i class="fas fa-pencil-alt fa-sm"></i></a>
                                    @else
                                        <a href="#" class="btn btn-info btn-sm" wire:click.prevent="$emit('userTriggerReset', {{ $user->id }})"><i class="fas fa-sync fa-sm"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('userTriggerDelete', {{ $user->id }})"><i class="fas fa-trash fa-sm"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            {{ $users->links('layouts.pagination-links') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal User {{ ucwords($level) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="namaLengkap">Nama Lengkap</label>
                      <input type="text"
                        class="form-control" wire:model.lazy="nama" aria-describedby="namaLengkap">
                        @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="username">Username / NIK / NIP</label>
                      <input type="text"
                        class="form-control" wire:model.lazy="username" name="username" id="username" aria-describedby="userName" {{ $modeEdit ? "readonly" : ''}}>
                        @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" wire:model.lazy="password" class="form-control">
                      @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password</label>
                        <input type="password" wire:model.lazy="repass" class="form-control">
                        @error('repass') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    @if($modeEdit == true)
                        <button type="button" class="btn btn-sm btn-primary" wire:click="doEditUser()">Simpan</button>
                    @else
                        <button type="button" class="btn btn-sm btn-primary" wire:click="simpanUser()">Simpan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
window.livewire.on('closeModalUser', () => {
    $('#modal-user').modal('hide');
    $('.modal-backdrop').each(function(){
        $(this).remove();
    });
});
$('#modal-user').on('hidden.bs.modal', function(){
    @this.call('clearFormUser');
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        @this.call('clearFormUser');
        $('#modal-user').modal('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('userTriggerEdit', orderId => {
        @this.call('userEdit', orderId);
        $('#modal-user').modal('toggle');
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('userTriggerReset', orderId => {
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
                @this.call('reset', orderId);
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('userTriggerDelete', orderId => {
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
                @this.call('userDelete', orderId);
            }
        });
    });
});
</script>
@endsection
