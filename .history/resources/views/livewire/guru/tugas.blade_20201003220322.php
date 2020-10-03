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
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tambah {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <button class="btn btn-primary" wire:click="$emit('toggleAddForm')"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('toggleAddForm', () => {
        // @this.call('clearForm');
        // CKEDITOR.instances['isimateri'].setData('');
        $('#collapseTambah').collapse('toggle');
    });
});
</script>
@endsection
