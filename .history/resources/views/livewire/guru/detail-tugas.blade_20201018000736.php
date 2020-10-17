<div>
    @include('layouts.header')
    @include('layouts.menu_guru')
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
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="text-capitalize">
                        {{ $heading['keterangan'] }}
                    </div>
                    <div class="btn-actions-pane-right">
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
        <div class="col-md-12" style="text-align: center;">
            {{ $respons->links('layouts.pagination-links') }}
        </div>
    </div>
    @if ($respons->count() == 0)
        <div class="alert alert-warning">
            Belum ada siswa yang mengumpulkan tugas
        </div>
    @endif
    @foreach ($respons as $respon)
        <div class="row">
            <div class="col-md-12">
                <div class="card-hover-shadow-2x mb-2 card">
                    <div class="card-header-tab card-header">
                        {{ $respon->author->name }}
                    </div>
                    <div class="card-body">
                        {!! $respon->jawaban !!}
                        <ul class="list-group">
                            <a href="/{{ $respon->file }}">
                                <li class="list-group-item list-group-item-action">
                                    @php
                                        $file = explode('/', $respon->file);
                                        echo end($file);
                                    @endphp
                                </li>
                            </a>
                        </ul><br>
                        <div class="row">
                            <div class="col-md-9">
                                <ul class="list-group">
                                    <li class="list-group-item bg-light">{{ $respon->komentar }}</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="list-group">
                                    <li class="list-group-item bg-info text-white">Nilai : {{ $respon->nilai }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input placeholder="Tulis komentar... tekan enter"  wire:model.lazy="inputKomen" wire:keydown.enter="simpanKomen({{ $respon->id }})" type="text" class="form-control-sm form-control">
                            <input placeholder="Berikan nilai... tekan enter"  wire:model.lazy="inputNilai" wire:keydown.enter="simpanNilai({{ $respon->id }})" type="text" class="form-control-sm form-control">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @include('layouts.footer')
</div>
@section('scripts')
<script>

</script>
@endsection
