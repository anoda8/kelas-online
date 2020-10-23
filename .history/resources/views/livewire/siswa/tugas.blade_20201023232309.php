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
                            <button type="button" class="btn btn-primary btn-sm ml-2" wire:click="today()">Tugas Hari Ini</button>
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
            {{ $tugase->links('layouts.pagination-links-simple') }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($tugase as $tugas)
            <div class="mb-2 card">
                <div class="card-header bg-info text-white font-size-lg text-capitalize" style="cursor:pointer;" wire:click.prevent="$emit('linkDetail', {{ $tugas->id }})">
                    [{{ $tugas->mapel->nama }}]&nbsp;{{ $tugas->judul }}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Dibuat Tanggal <br>
                            <span class="font-weight-bold">{{ date("d/m/Y H:i:s", strtotime($tugas->created_at)) }}</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Respon <br>
                            <span class="font-weight-bold">{{ $tugas->respon->count() }} Anak</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="font-weight-bold text-danger">{{ $tugas->kelas->nama }}</span>
                    <div class="btn-actions-pane-right">
                        Guru : <b>{{ $tugas->author->name }}</b>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            {{ $tugase->links('layouts.pagination-links-simple') }}
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
        window.location.href = '/siswa/tugas/detail/'+ kelonId;
    });
});
</script>
@endsection
