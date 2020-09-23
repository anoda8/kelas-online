<div wire:ignore.self class="modal fade" id="modal-tambah-thajaran" tabindex="-1" style="z-index: 10000;" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Tahun Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <div>
                            <input type="text" wire:model.lazy="tambah_tahun" class="form-control">
                            @error('tambah_tahun') <span class="text-danger error">{{ $message }}</span>@enderror
                            {{ $tambah_tahun }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <div>
                            <select wire:model.lazy="tambah_semester" class="form-control">
                                <option value="1">1 (Satu)</option>
                                <option value="2">2 (Dua)</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <i>Centang agar terpilih secara otomatis saat login</i>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tambah_status">
                            <label class="custom-control-label" for="tambah_status">Aktif</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary clos-modal" wire:click="store()">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
