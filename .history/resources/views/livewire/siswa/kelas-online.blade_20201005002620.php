<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
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
            @foreach ($kelons as $kelon)
            <div class="mb-2 card">
                <div class="card-header bg-warning text-white" style="cursor:pointer;" wire:click="$emit('linkDetail', {{ $kelon->id }})">
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
                            <span class="font-weight-bold">30 Anak</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Tidak Masuk <br>
                            <span class="font-weight-bold">6 Anak</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="font-weight-bold text-danger">{{ $kelon->kelas->nama }}</span>
                    <div class="btn-actions-pane-right">
                        <div class="form-inline">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('linkDetail', kelonId => {
        window.location.href = '/siswa/kelasonline/detail/'+ kelonId;
    });
});
</script>
@endsection
