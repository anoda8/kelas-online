<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                {{-- <a href="{{ route('siswa.pengumuman') }}" data-toggle="tooltip" title="Kembali" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-arrow-left"></i>
                </a> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        {{ $kelas->materi }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        @if (session('_openClass') == session('_token'))
                            <div class="text-right">
                                <button class="btn btn-danger" wire:click="$emit('tanyaKeluar')">Keluar Kelas</button>
                            </div>
                        @else
                            <div class="text-right">
                                <button class="btn btn-primary mr-3" wire:click="masuk()">Masuk Kelas</button>
                                <a class="btn btn-dark" href="{{ route('siswa.kelasonline') }}" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    {!! $kelas->isi_materi !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
                    <div class="scroll-area-lg">
                    <ul class="list-group">
                        @foreach ($here as $online)
                            <li class="list-group-item list-group-item-sm mb-2">{{ $online['user']['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('dilarangMasuk', () => {
        Swal.fire({
            title: 'Peringatan !',
            text: 'Anda sedang aktif di kelas lain, silahkan keluar dulu !',
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: 'var(--success)',
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'Hapus !'
        }).then(() => {
            window.location.href="/siswa/kelasonline";
        });
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('tanyaKeluar', () => {
        Swal.fire({
            title: 'Peringatan !',
            text: 'Apakah anda yakin akan keluar kelas ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: 'var(--success)',
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'Ya !'
        }).then((index) => {
            if(index.value){
                @this.call('keluar');
            }
        });
    });
});
// const KELON_ID = "{{ $kelonid }}";
// var channelname = 'kelonChat'+KELON_ID;
// window.Echo.join(channelname)
// .listen('.KelonPesanEvent', (e) => {
//     // console.log(e);
//     @this.call('pesanMasuk', e)
// });
</script>
@endsection
