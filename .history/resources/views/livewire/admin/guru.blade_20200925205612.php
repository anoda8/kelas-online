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
                                    <th class="text-center">Login Terakhir</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                <tr>

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
