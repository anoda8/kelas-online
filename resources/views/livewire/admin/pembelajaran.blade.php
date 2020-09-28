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
                <div class="pt-3 card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group" wire:ignore>
                              <label for=""></label>
                              <select class="form-control pilih-mapel" wire:model="mapel">
                                <option value="1">Satu</option>
                                <option value="2">Dua</option>
                                <option value="3">Tiga</option>
                              </select>
                            </div>
                            {{ $mapel }}
                        </div>
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
        @this.set('mapel', e.target.value);
        // $(".pilih-mapel").select2();
    })
});
</script>
@endsection
