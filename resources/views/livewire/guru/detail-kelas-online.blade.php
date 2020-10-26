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
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        <a href="/guru/kelasonline/presensi/{{ $kelons->id }}" class="btn btn-warning mt-1" target="_blank"><i class="fas fa-print"></i>&nbsp;&nbsp;Presensi</a>
                        {{-- <a href="/guru/kelasonline/cetak/{{ $kelons->id }}" class="btn btn-info mt-1"><i class="fas fa-print"></i>&nbsp;&nbsp;Detail Laporan</a> --}}
                        <a href="/guru/kelasonline/cetak/{{ $kelons->id }}" class="btn btn-info mt-1"><i class="fas fa-print"></i>&nbsp;&nbsp;Unduh Laporan</a>
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
                            <a href="/{{ $kelons->file }}" target="_blank">
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
                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Percakapan&nbsp;&nbsp;<br><small><i>(Tekan tombol refresh dibawah untuk menampilkan pesan baru)</i></small>
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">

                    </div>
                </div>
                <div class="scroll-area-lg" id="scrollChat">
                    <div class="p-2">
                        <div class="chat-wrapper p-1">
                            @foreach ($komentare as $komentar)
                                @if ($komentar->author_id == auth()->id())
                                <div class="card mb-2 alert-primary">
                                    <div class="card-body d-flex justify-content-between row">
                                        <div class="col-md-3 col-sm-4">
                                            <div class="avatar-icon avatar-icon-sm rounded">
                                                <img src="{{ asset('images/avatars/1.jpg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="user-info text-right col-md-9 col-sm-8">
                                            <h6 class="card-subtitle mb-2 text-muted"><b>{{ $komentar->author->name }}</b></h6>
                                            <small>{{ date("d-m-Y H:i", strtotime($komentar->created_at)) }} | {{ $komentar->created_at->diffForHumans() }}</small><br>
                                            {{ $komentar->komentar }}
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="card mb-2 alert-default">
                                    <div class="card-body d-flex justify-content-between row">
                                        <div class="user-info text-left col-md-9 col-sm-8">
                                            <h6 class="card-subtitle mb-2 text-muted"><b>{{ $komentar->author->name }}</b></h6>
                                            <small>{{ date("d-m-Y H:i", strtotime($komentar->created_at)) }} | {{ $komentar->created_at->diffForHumans() }}</small><br>
                                            {{ $komentar->komentar }}
                                        </div>
                                        <div class="col-md-3 col-sm-4">
                                            <div class="avatar-icon avatar-icon-sm rounded pull-right">
                                                <img src="{{ asset('images/avatars/1.jpg') }}" alt="">
                                            </div>
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
                        <input placeholder="Tulis komentar.."  wire:model.lazy="inputChat" wire:keydown.enter="$emit('triggerSimpanKomen')" type="text" class="form-control-sm form-control">
                        <div class="input-group-append ml-3">
                            <button class="btn btn-primary btn-sm" wire:click="$emit('triggerReloadChat')"><i class="fas fa-sync"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Presensi
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($here as $online)
                            <li class="list-group-item list-group-item-action list-group-item-success mb-1"><b>{{ $online['user']['name'] }}</b>&nbsp;&nbsp;({{ date("H:i", strtotime($online['user']['created_at'])) }})</li>
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
    @this.on('triggerSimpanKomen', () => {
        @this.call('simpanKomen');
        var objDiv = document.getElementById("scrollChat");
        objDiv.scrollTop = objDiv.scrollHeight + 50;
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('triggerReloadChat', () => {
        @this.call('reloadChat');
        var objDiv = document.getElementById("scrollChat");
        objDiv.scrollTop = objDiv.scrollHeight + 50;
    });
});
</script>
@endsection
