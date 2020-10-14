<div>
    @include('layouts.header')
    @include('layouts.menu_guru')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        {{ $heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="">
                                @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" placeholder="" readonly>
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" class="form-control" placeholder="">
                                @error('pass') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password</label>
                                <input type="text" class="form-control" placeholder="">
                                @error('repass') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img class="img-responsive" src="{{ url('images/nopict.png') }}" alt="Foto Profil" width="100%">
                            <label for="">Upload Foto Profil</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" wire:model="fileimport" class="custom-file-input">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ $fileimport ? $fileimport->getClientOriginalName() : "Pilih Gambar" }}</label>
                                </div>
                            </div>
                            @error('fotoprofil') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-actions-pane-right">
                        <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
