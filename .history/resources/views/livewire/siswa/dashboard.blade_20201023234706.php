<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
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
    @if ($saranGantiPassword)
    <div class="alert alert-warning">
        <strong>Peringatan ! </strong> Anda belum mengganti password bawaan, segera ganti password untuk keamanan !
        <a href="{{ route('siswa.profil') }}">Ganti Password</a>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-grow-early" style="cursor:pointer;" wire:click="$emit('dataKelon')">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Kelas Online</div>
                        <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $jumlah['kelon'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-plum-plate" style="cursor:pointer;" wire:click="$emit('dataTugas')">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Tugas</div>
                        <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $jumlah['tugas'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Siswa Aktif Saat Ini</div>
                        <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Siswa Aktif Hari Ini</div>
                        <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span></span></div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold"><i
                            class="header-icon fas fa-bullhorn mr-3 text-muted opacity-6"> </i>Pengumuman
                    </div>
                    <div class="btn-actions-pane-right actions-icon-btn">
                        {{-- <div class="btn-group dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn-icon btn-icon-only btn btn-link">
                                <i class="pe-7s-menu btn-icon-wrapper"></i>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                </button>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <div class="p-3 text-right">
                                    <button class="mr-2 btn-shadow btn-sm btn btn-link">View Details</button>
                                    <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($data['pengumuman'] as $peng)
                            <li class="list-group-item list-group-item-info list-group-item-action mb-2">{{ $peng->author->name }} - <b>{{ $peng->judul }}</b> [{{ $peng->komentar->count() }}]</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold"><i class="header-icon fas fa-chalkboard-teacher mr-3 text-muted opacity-6"> </i>Kelas Online Hari Ini {{ date("d/m/Y") }} ({{ $data['kelon']->count() }})
                    </div>
                    <div class="btn-actions-pane-right actions-icon-btn">

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($data['kelon'] as $kelon)
                            <li class="list-group-item {{ $kelon->log->count() > 0 ? ($kelon->log[0]->status == true ? "list-group-item-danger" : "list-group-item-default") : "list-group-item-info" }} list-group-item-action mb-2"
                                wire:click="$emit('linkKelon',{{ $kelon->id }})"
                                style="{{ $kelon->log->count() == 0 ? "cursor: pointer;" : "" }}"><b>
                                {{ $kelon->log->count() > 0 ? $kelon->log[0]->id : "" }}
                                {{ $kelon->mapel->nama }} [{{ $kelon->author->name }}] - {{ $kelon->wkt_masuk->format("H:i") }} s/d {{ $kelon->wkt_selesai->format("H:i") }} </b>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold"><i class="header-icon fas fa-chalkboard-teacher mr-3 text-muted opacity-6"> </i>Tugas Terbaru
                    </div>
                    <div class="btn-actions-pane-right actions-icon-btn">

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($data['tugas'] as $tugas)
                            <li class="list-group-item list-group-item-info list-group-item-action mb-2"><b>{{ $tugas->mapel->nama }} [{{ $tugas->author->name }}]</b> - {{ $tugas->judul }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('dataKelon', () => {
        window.location.href="/siswa/kelasonline";
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('dataTugas', () => {
        window.location.href="/siswa/tugas";
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('linkKelon', idKelon => {
        window.location.href="/siswa/kelasonline/detail/"+idKelon;
    });
});
</script>
@endsection
