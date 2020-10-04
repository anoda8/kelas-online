<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                <a href="{{ route('siswa.pengumuman') }}" data-toggle="tooltip" title="Kembali" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! $peng->isi_pengumuman !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! $peng->isi_pengumuman !!}
                </div>
            </div>
        </div>
    </div>
</div>
