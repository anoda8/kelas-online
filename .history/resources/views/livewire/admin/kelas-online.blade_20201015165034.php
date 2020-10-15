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
                        {{ $heading['judul'] }} ({{ $kelons->count() }})
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            {{ $kelons->paginate($perpage)->links('layouts.pagination-links-simple') }}
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
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Jumlah Siswa Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelons->paginate($perpage) as $index => $kelon)
                                <tr>
                                    <td>{{ ($index + 1) + (($kelons->paginate($perpage)->currentPage() - 1) * $kelons->paginate($perpage)->perPage()) }}</td>
                                    <td>{{ $kelon->author->name }}</td>
                                    <td>{{ $kelon->mapel->nama }}</td>
                                    <td style="width:100px;">{{ $kelon->kelas->nama }}</td>
                                    <td class="text-center">{{ $kelon->wkt_masuk->format("d-m-Y") }}&nbsp;{{ $kelon->wkt_masuk->format("H:i") }} s/d {{ $kelon->wkt_selesai->format("H:i") }}</td>
                                    <td class="text-center">{{ $kelon->log->count() }}</td>
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
