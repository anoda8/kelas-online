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
                    {{ $heading['keterangan'] }}
                    <div class="btn-actions-pane-right text-capitalize">
                        <a class="btn btn-primary mt-1" href="{{ route('guru.tugas') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    {!! $tugas->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    Ahmad Hijab
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action">Document.docx</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input placeholder="Tulis komentar.."  wire:model.lazy="inputChat" wire:keydown.enter="simpanKomen()" type="text" class="form-control-sm form-control">
                        <input placeholder="Berikan nilai.."  wire:model.lazy="inputChat" wire:keydown.enter="simpanKomen()" type="text" class="form-control-sm form-control">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>

</script>
@endsection
