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
                <div class="card-header-tab card-header bg-warning">
                    <div class="col-md-8 col-sm-12">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="col-md-4 col-sm-12 text-right">
                        <a class="btn btn-primary mt-1" href="{{ route('guru.kelasonline') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tanggal : {{ date("d/m/Y", strtotime($kelons->wkt_masuk)) }} => Pukul {{ date("H:i", strtotime($kelons->wkt_masuk)) }} s/d {{ date("H:i", strtotime($kelons->wkt_selesai)) }}
                    </div>
                </div>
                <div class="card-body">
                    {!! $kelons->isi_materi !!}
                    <hr>
                    <div class="video-container">
                        <iframe width="748" height="421" src="https://www.youtube.com/embed/hT_nvWreIhg?list=RDtcHJodG5hX8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item">Document.xlsx</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="header-icon lnr-printer icon-gradient bg-ripe-malin"> </i>Chat Box
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
                                        <div class="col-md-9 col-sm-5 text-right" style="border: 1px solid;">
                                            <small class="font-weight-bold">{{ $komentar->author->name }}</small><br>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small><br>
                                            {{ $komentar->komentar }}
                                        </div>
                                        <div class="col-md-3 col-sm-3">
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
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small><br>
                                            hai guys bagai mana kali ini kita akan berkata kata apapun yang terjadi kita akan membuat aplikasi ini,
                                            kita akan terus membuat ini sampai jadi, kita jual, kita bisa untuk banyak dan buktikan sama semua orang kalau kita bisa
                                            hai guys bagai mana kali ini kita akan berkata kata apapun yang terjadi kita akan membuat aplikasi ini,
                                            kita akan terus membuat ini sampai jadi, kita jual, kita bisa untuk banyak dan buktikan sama semua orang kalau kita bisa
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input placeholder="Tulis komentar.." wire:model.lazy="inputChat" wire:keydown.enter="simpanKomen()" type="text" class="form-control-sm form-control">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-2 card">
                <div class="card-header">

                </div>
            </div>
        </div>
    </div>
</div>
