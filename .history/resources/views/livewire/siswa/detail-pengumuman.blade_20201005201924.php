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
            <div class="card mb-2">
                <div class="card-body">
                    {!! $peng->isi_pengumuman !!}
                    <hr>
                    Oleh : {{ $peng->author->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
                                        <div class="p-1 mb-2 bg-info text-white rounded clearfix">
                                            <div class="row">
                                                <div class="col-lg-11 col-md-10 col-sm-7 text-right mb-3">
                                                    <small class="font-weight-bold">{{ $komentar->author->name }}</small><br>
                                                    <small class="opacity-6">
                                                        <i class="fa fa-calendar-alt mr-1"></i>
                                                        {{ date("d-m-Y H:i", strtotime($komentar->created_at)) }} | {{ $komentar->created_at->diffForHumans() }}
                                                    </small><br>
                                                    <span class="komentar">{{ $komentar->komentar }}</span>
                                                </div>
                                                <div class="col-lg-1 col-md-2 col-sm-5">
                                                    <div class="avatar-icon avatar-icon-sm rounded pull-right">
                                                        <img src="{{ asset('images/avatars/1.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="p-3 mb-2 bg-light text-dark rounded clearfix">
                                            <div class="row">
                                                <div class="col-md-1 col-sm-3">
                                                    <div class="avatar-icon avatar-icon-sm rounded pull-left mb-2">
                                                        <img src="{{ asset('images/avatars/1.jpg') }}" alt=""><br>
                                                    </div>
                                                </div>
                                                <div class="col-md-11 col-sm-5 text-justify">
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
                                <input placeholder="Tulis komentar.. tekan enter"  wire:model.lazy="inputChat" wire:keydown.enter="simpanKomen()" type="text" class="form-control-sm form-control">
                                <div class="input-group-append ml-3">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-sync"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
