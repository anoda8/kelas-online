<div>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Pengaturan
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-business-time fa-w-20"></i>
                        </span>
                        Buttons
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>
                                        Inbox
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span>
                                        Book
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span>
                                        Picture
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a disabled href="" class="nav-link disabled">
                                    <i class="nav-link-icon lnr-file-empty"></i>
                                    <span>
                                        File Disabled
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-5 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Daftar Tahun Pelajaran
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="table-responsive" style="max-height: 253px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_thajaran as $thajaran)
                                <tr style="cursor:pointer;background-color: {{ $thajaran->status == 1 ? "lightgreen" : "" }}">
                                    <td scope="row">{{ $thajaran->kode }}</td>
                                    <td class="text-center">{{ $thajaran->semester }}</td>
                                    <td>{{ $thajaran->keterangan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tambah Tahun Pelajaran
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <div>
                            <input type="text" wire:model.lazy="tambah_tahun" class="form-control">
                            @error('tambah_tahun') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <div>
                            <select wire:model.lazy="tambah_semester" class="form-control">
                                <option value="">== Pilih Semester ==</option>
                                <option value="1">1 (Satu)</option>
                                <option value="2">2 (Dua)</option>
                            </select>
                        </div>
                        @error('tambah_semester') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <i>Centang agar terpilih secara otomatis saat login</i>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" wire:model.lazy="tambah_status" class="custom-control-input" id="tambah_status" value="1">
                            <label class="custom-control-label" for="tambah_status">Aktif</label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success btn-sm" wire:click.prevent="store()">Tambah</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @section('scripts')
    <script type="text/javascript">
        window.livewire.on('thAjaranStore', () => {
            $('#modal-tambah-ajaran').modal('hide');
        });
        document.addEventListener('DOMContentLoaded', ()=>{

        });
    </script>
    @endsection
</div>

