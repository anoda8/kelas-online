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
            @foreach ($pengumuman as $peng)
            <div class="mb-2 card">
                <div class="card-header-tab card-header bg-light" wire:click="$emit('linkDetail', {{ $peng->id }})" style="cursor: pointer;">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-bold">
                        {{ $peng->judul }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="pt-3 card-body">
                    {!! $peng->isi_pengumuman !!}
                </div>
                <div class="card-footer">
                    Oleh : {{ $peng->author->name }} &nbsp; || Dilihat : 60 || Komentar : {{ $peng->komentar->count() }}
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
    @this.on('linkDetail', pengId => {
        window.location.href = '/siswa/pengumuman/detail/'+ pengId;
    });
});
</script>
@endsection
