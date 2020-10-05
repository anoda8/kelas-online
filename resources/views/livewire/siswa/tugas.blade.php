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
            @foreach ($tugase as $tugas)
            <div class="mb-2 card">
                <div class="card-header bg-info text-white" style="cursor:pointer;">
                    <a href="/guru/tugas/detail/{{ $tugas->id }}" style="text-decoration: none;color:#000;">[{{ $tugas->mapel->nama }}]&nbsp;{{ $tugas->judul }}</a>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Dilihat Oleh <br>
                            <span class="font-weight-bold">30 Anak</span>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center" style="border-bottom:solid 1px;">
                            Respon <br>
                            <span class="font-weight-bold">6 Anak</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="font-weight-bold text-danger">{{ $tugas->kelas->nama }}</span>
                    <div class="btn-actions-pane-right">
                        <div class="form-inline">
                            <button class="btn btn-danger ml-2" wire:click="$emit('triggerHapus', {{ $tugas->id }})"><i class="fas fa-trash"></i> Hapus</button>
                            <button class="btn btn-warning ml-2" wire:click="$emit('triggerSalin', {{ $tugas->id }})"><i class="fas fa-copy"></i> Salin</button>
                            <button class="btn btn-info ml-2" wire:click="$emit('triggerEdit', {{ $tugas->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
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

@endsection
