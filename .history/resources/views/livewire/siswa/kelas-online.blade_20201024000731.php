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
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-body">
                    <form class="form-inline">
                        <div class="form-group mr-2">
                            <div wire:ignore>
                            <select class="form-control form-control-sm pilih-mapel" wire:model.lazy="katakunciMapel">
                                <option>== Pilih Mapel ==</option>
                                @foreach ($pembelajaran as $pembl)
                                    <option value="{{ $pembl->mapel_id }}">{{ $pembl->mapel->nama }} - {{ $pembl->mapel->guru->nama }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="date" placeholder="Cari materi" class="form-control form-control-sm" wire:model="katakunciTgl">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm ml-2" wire:click="today()">Kelas Hari Ini</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm ml-2" wire:click="clearSearch()"><i class="fas fa-sync"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            {{ $kelons->links('layouts.pagination-links-simple') }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($kelons as $kelon)
            <div class="mb-2 card">
                <div class="card-header font-size-lg text-capitalize bg-warning text-dark">
                    [{{ $kelon->mapel->nama }}]&nbsp;{{ $kelon->materi }}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Mulai Tanggal / Pukul <br>
                            <span class="font-weight-bold">{{ date("d-m-Y / H:i", strtotime($kelon->wkt_masuk)) }} WIB</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Sampai Tanggal / Pukul <br>
                            <span class="font-weight-bold">{{ date("d-m-Y / H:i", strtotime($kelon->wkt_selesai)) }} WIB</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Hadir <br>
                            <span class="font-weight-bold">{{ $kelon->log->count() }} Anak</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Guru <br>
                            <span class="font-weight-bold">{{ $kelon->author->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="font-weight-bold text-danger">{{ $kelon->kelas->nama }}</span>
                    <div class="btn-actions-pane-right">
                        <div class="form-inline">
                            @if ((strtotime(now()) > strtotime($kelon->wkt_masuk)) && (strtotime(now()) < strtotime($kelon->wkt_selesai)))
                                @if ($kelasAktif->count() > 0)
                                    @if ($kelasAktif->first()->kelon_id == $kelon->id)
                                        <button class="btn btn-primary" wire:click="$emit('linkDetail', {{ $kelon->id }})">Masuk Kelas</button>
                                    @endif
                                @else
                                    <button class="btn btn-primary" wire:click="$emit('linkDetail', {{ $kelon->id }})">Masuk Kelas</button>
                                @endif
                            @endif
                        </div>
                        {{-- @if ($kelasaktif->count() > 0)
                            @if ($kelasaktif->first()->kelon_id == $kelon->id)
                                <div class="form-inline">
                                    <button class="btn btn-primary" wire:click="$emit('linkDetail', {{ $kelon->id }})">Masuk Kelas</button>
                                </div>
                            @endif
                        @else
                            <div class="form-inline">
                                <button class="btn btn-primary" wire:click="$emit('linkDetail', {{ $kelon->id }})">Masuk Kelas</button>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            {{ $kelons->links('layouts.pagination-links-simple') }}
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
$(document).ready(function () {
    $(".pilih-mapel").select2();
    $(".pilih-mapel").on('change', function(e){
        @this.set('katakunciMapel', e.target.value);
    })
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('linkDetail', kelonId => {
        Swal.fire({
            title: 'Konfirmasi Masuk Kelas',
            text: 'Anda akan masuk kelas ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: 'var(--success)',
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'Masuk !'
        }).then((result) => {
            if(result.value){
                @this.call('masukKelas', kelonId);
            }
        });
    });
});
</script>
@endsection
