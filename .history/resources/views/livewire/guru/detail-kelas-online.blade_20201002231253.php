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
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a class="btn btn-primary" href="{{ route('guru.kelasonline') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <div class="scrollbar-container">
                        <div class="p-2">
                            <div class="chat-wrapper p-1">
                                <div class="chat-box-wrapper">
                                    <div>
                                        <div class="avatar-icon-wrapper mr-1">
                                            <div
                                                class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div>
                                            <div class="avatar-icon avatar-icon-lg rounded">
                                                <img src="{{ asset('images/avatars/1.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="chat-box">But I must explain to you how all this mistaken
                                            idea of denouncing pleasure and praising pain was born and I will
                                            give you a complete account of the system.</div>
                                        <small class="opacity-6">
                                            <i class="fa fa-calendar-alt mr-1"></i>
                                            11:01 AM | Yesterday
                                        </small>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <div class="chat-box-wrapper chat-box-wrapper-right">
                                        <div>
                                            <div class="chat-box">Expound the actual teachings of the great
                                                explorer of the truth, the master-builder of human happiness.
                                            </div>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small>
                                        </div>
                                        <div>
                                            <div class="avatar-icon-wrapper ml-1">
                                                <div
                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                                </div>
                                                <div class="avatar-icon avatar-icon-lg rounded">
                                                    <img src="assets/images/avatars/3.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-box-wrapper">
                                    <div>
                                        <div class="avatar-icon-wrapper mr-1">
                                            <div
                                                class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div>
                                            <div class="avatar-icon avatar-icon-lg rounded">
                                                <img src="assets/images/avatars/2.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="chat-box">But I must explain to you how all this mistaken
                                            idea of denouncing pleasure and praising pain was born and I will
                                            give you a complete account of the system.</div>
                                        <small class="opacity-6">
                                            <i class="fa fa-calendar-alt mr-1"></i>
                                            11:01 AM | Yesterday
                                        </small>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <div class="chat-box-wrapper chat-box-wrapper-right">
                                        <div>
                                            <div class="chat-box">Denouncing pleasure and praising pain was born
                                                and I will give you a complete account.</div>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small>
                                        </div>
                                        <div>
                                            <div class="avatar-icon-wrapper ml-1">
                                                <div
                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                                </div>
                                                <div class="avatar-icon avatar-icon-lg rounded">
                                                    <img src="assets/images/avatars/2.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <div class="chat-box-wrapper chat-box-wrapper-right">
                                        <div>
                                            <div class="chat-box">The master-builder of human happiness.</div>
                                            <small class="opacity-6">
                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                11:01 AM | Yesterday
                                            </small>
                                        </div>
                                        <div>
                                            <div class="avatar-icon-wrapper ml-1">
                                                <div
                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                                </div>
                                                <div class="avatar-icon avatar-icon-lg rounded">
                                                    <img src="assets/images/avatars/2.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input placeholder="Write here and hit enter to send..." type="text" class="form-control-sm form-control">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-2 card">
                <div class="card-header">
                    Absensi
                </div>
            </div>
        </div>
    </div>
</div>
