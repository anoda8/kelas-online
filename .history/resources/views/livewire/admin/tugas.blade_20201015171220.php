<div>
    @include('layouts.header')
    @include('layouts.menu')
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
                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        {{ $heading['judul'] }} ({{ $tugase->count() }})
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            {{ $tugase->paginate($perpage)->links('layouts.pagination-links-simple') }}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Mapel</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Jumlah Respon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugase->paginate($perpage) as $index => $tugas)
                                <tr title="{{ $tugas->judul }}">
                                    <td>{{ ($index + 1) + (($tugas->paginate($perpage)->currentPage() - 1) * $tugas->paginate($perpage)->perPage()) }}</td>
                                    <td>{{ $tugas->author->name }}</td>
                                    <td>{{ $tugas->mapel->nama }}</td>
                                    <td>{{ $tugas->kelas->nama }}</td>
                                    <td class="text-center">{{ $tugas->respon->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
