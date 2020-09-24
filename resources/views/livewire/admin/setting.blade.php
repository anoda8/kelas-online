<div>
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
                                    <th class="text-center">
                                        Hapus
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_thajaran as $thajaran)
                                <tr style="background-color: {{ $thajaran->status == 1 ? "lightgreen" : "" }}">
                                    <td scope="row">{{ $thajaran->kode }}</td>
                                    <td class="text-center">{{ $thajaran->semester }}</td>
                                    <td>
                                        <a href="#" style="cursor:pointer;" wire:click.prevent="thAjaranAktif({{ $thajaran->id }})">{{ $thajaran->keterangan }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="$emit('thAjaranTriggerDelete', {{ $thajaran->id }})"><i class="fas fa-trash fa-sm"></i></a>
                                    </td>
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
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select class="form-control" wire:model.lazy="tambah_tahun" id="tahun">
                                <option value="">== Pilih Tahun ==</option>
                                @for ($i = 2020; $i <= 2030; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
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
                        <button class="btn btn-success btn-sm" wire:click.prevent="thAjaranStore()">Tambah</button>
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
            @this.on('thAjaranTriggerDelete', orderId => {
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
                        @this.call('thAjaranHapus', orderId);
                    }
                });
            });
        });
    </script>
    @endsection
</div>

