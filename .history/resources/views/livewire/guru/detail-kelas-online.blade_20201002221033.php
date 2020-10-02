<div>
    @include('layouts.header')
    @include('layouts.menu_guru')
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
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a class="btn btn-primary" href="{{ route('guru.kelasonline') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    {!! $kelons->isi_materi !!}
                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>
