<div>
    @include('layouts.header')
    @include('layouts.menu_siswa')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                <a href="{{ route('siswa.tugas') }}" data-toggle="tooltip" title="Kembali" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-header text-capitalize">
                    [{{ $tugas->mapel->nama }}] {{ $tugas->judul }}
                </div>
                <div class="card-body">
                    {!! $tugas->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-capitalize">
                    Respon Tugas
                </div>
                <div class="card-body">
                    <div class="form-group">
                      <label for="">Isi Respon Tugas</label>
                      <textarea class="form-control" id="respontugas" name="respontugas" wire:model.lazy="respontugas" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
CKEDITOR.replace( 'isimateri' );
</script>
@endsection
