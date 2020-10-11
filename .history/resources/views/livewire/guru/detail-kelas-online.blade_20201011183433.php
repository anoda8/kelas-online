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
                    <div class="col-md-8 col-sm-12 text-capitalize font-size-lg">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="col-md-4 col-sm-12 text-right">
                        <a class="btn btn-primary mt-1" href="{{ route('guru.kelasonline') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-header-tab card-header">
                    <div class="card-header-title text-capitalize font-weight-bold">
                        Tanggal : {{ date("d/m/Y", strtotime($kelons->wkt_masuk)) }} => Pukul {{ date("H:i", strtotime($kelons->wkt_masuk)) }} s/d {{ date("H:i", strtotime($kelons->wkt_selesai)) }}
                    </div>
                </div>
                <div class="card-body">
                    {!! $kelons->isi_materi !!}
                    <hr>
                    <div class="video-container">
                        {!! $kelons->video_path !!}
                    </div>
                    <hr>
                    @if ($kelons->file != null)
                        <ul class="list-group">
                            <a href="/{{ $kelons->file }}">
                                <li class="list-group-item bg-light">
                                    @php
                                        $linkfile = explode('/', $kelons->file);
                                        echo end($linkfile);
                                    @endphp
                                </li>
                            </a>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="header-icon lnr-printer icon-gradient bg-ripe-malin"> </i>Percakapan
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">

                    </div>
                </div>
                <div class="scroll-area-lg">
                    <div class="p-2">
                        <div class="chat-wrapper p-1">
                            @foreach ($komentare as $komentar)
                                @if ($komentar->author_id == auth()->id())
                                <div class="p-1 mb-2 bg-primary text-white rounded clearfix">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-7 text-right mb-3">
                                            <small class="font-weight-bold">{{ $komentar->author->name }}</small><br>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                {{ date("d-m-Y H:i", strtotime($komentar->created_at)) }} | {{ $komentar->created_at->diffForHumans() }}
                                            </small><br>
                                            <span class="komentar">{{ $komentar->komentar }}</span>
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            <div class="avatar-icon avatar-icon-sm rounded pull-right">
                                                <img src="{{ asset('images/avatars/1.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="p-3 mb-2 bg-light text-dark rounded clearfix">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="avatar-icon avatar-icon-sm rounded pull-left mb-2">
                                                <img src="{{ asset('images/avatars/1.jpg') }}" alt=""><br>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-5 text-justify">
                                            <small class="font-weight-bold">{{ $komentar->author->name }}</small><br>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small><br>
                                            <span class="komentar">{{ $komentar->komentar }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input placeholder="Tulis komentar.."  wire:model.lazy="inputChat" wire:keydown.enter="simpanKomen()" type="text" class="form-control-sm form-control">
                        <div class="input-group-append ml-3">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-sync"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="header-icon lnr-printer icon-gradient bg-ripe-malin"> </i>Kehadiran Siswa
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($here as $online)
                            <li class="list-group-item">{{ $online['user']['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
const KELON_ID = "{{ $kelonid }}";
var pusher = new Pusher('02f6ec86d345bf2199a5', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('KelonChatEvent');
channel.bind('kelonChat'+KELON_ID, function(data) {
    alert(JSON.stringify(data));
});
</script>
@endsection
