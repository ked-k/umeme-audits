<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12 mt-3">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="mb-2 mb-sm-0">
                                    {{-- @if (!$toggleForm) --}}
                                        Assets and Equipments 
                                        {{-- (<span
                                            class="text-danger fw-bold">{{ $countries->total() }}</span>) --}}
                                        {{-- @include('livewire.layouts.partials.inc.filter-toggle') --}}
                                    {{-- @else
                                        Edit Assets
                                    @endif --}}

                                </h5>
                                {{-- @include('livewire.layouts.partials.inc.create-resource') --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="new-resource">
                        <form wire:submit.prevent="storeCountry">
                        {{-- <form
                            @if (!$toggleForm) wire:submit.prevent="storeCountry"
                            @else
                            wire:submit.prevent="updateCountry" @endif> --}}
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="countryName" class="form-label">Name<small class="text-danger fw-bold">*</small></label>
                                    <input type="text" id="countryName" class="form-control" name="name"
                                        wire:model.defer="name">
                                    @error('name')
                                        <div class="text-danger text-small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="region_id" class="form-label">Region<small class="text-danger fw-bold">*</small></label>
                                    <select class="form-select select2" id="region_id" wire:model.lazy="region_id">
                                        <option selected value="">Select</option>
                                        {{-- @forelse ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @empty
                                        @endforelse --}}
                                    </select>
                                    @error('region_id')
                                        <div class="text-danger text-small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- @if (!$toggleForm)
                                    <x-button class="btn-success">{{ __('Save') }}</x-button>
                                @else
                                    <x-button class="btn-success">{{ __('Update') }}</x-button>
                                @endif --}}
                            </div>
                        </form>
                        <hr>
                    </div>

                    <div class="tab-content">
                        <div class="row mb-0">
                            {{-- <div class="row mb-0" @if (!$filter) hidden @endif> --}}
                            <h6>Filter Assets and Equipments</h6>

                            <div class="mb-3 col-md-4">
                                <label for="country_region_id" class="form-label">Region</label>
                                <select class="form-select select2" id="country_region_id"
                                    wire:model="country_region_id">
                                    <option selected value="0">All</option>
                                    {{-- @forelse ($regions as $region)
                                        <option value='{{ $region->id }}'>{{ $region->name }}</option>
                                    @empty
                                    @endforelse --}}
                                </select>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="mt-4 col-md-1">
                                <a type="button" class="btn btn-outline-success me-2" wire:click="export()">Export</a>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="from_date" class="form-label">From Date</label>
                                <input id="from_date" type="date" class="form-control" wire:model.lazy="from_date">
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="to_date" class="form-label">To Date</label>
                                <input id="to_date" type="date" class="form-control" wire:model.lazy="to_date">
                            </div>

                            <div class="mb-3 col-md-1">
                                <label for="perPage" class="form-label">Per Page</label>
                                <select wire:model="perPage" class="form-select" id="perPage">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="orderBy" class="form-label">OrderBy</label>
                                <select wire:model="orderBy" class="form-select">
                                    <option value="name">Name</option>
                                    <option value="id">Latest</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-1">
                                <label for="orderAsc" class="form-label">Order</label>
                                <select wire:model="orderAsc" class="form-select" id="orderAsc">
                                    <option value="1">Asc</option>
                                    <option value="0">Desc</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="search" class="form-label">Search</label>
                                <input id="search" type="text" class="form-control"
                                    wire:model.debounce.300ms="search" placeholder="search">
                            </div>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table id="datableButton" class="table table-striped mb-0 w-100 sortable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Region</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($countries as $key => $country)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $country->name }}</td>
                                            <td>{{ $country->region->name }}</td>
                                            <td class="table-action">
                                                <button class="action-ico btn btn-outline-success mx-1"
                                                    wire:click="editdata({{ $country->id }})"><i
                                                        class="bx bx-edit"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="btn-group float-end">
                                    {{-- {{ $countries->links('vendor.livewire.bootstrap') }} --}}
                                </div>
                            </div>
                        </div>
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    {{-- @push('scripts')
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        <script>
            window.addEventListener('livewire:load', () => {
                initializeSelect2();
            });

            $('#region_id').on('select2:select', function(e) {
                var data = e.params.data;
                @this.set('region_id', data.id);
            });

            $('#country_region_id').on('select2:select', function(e) {
                var data = e.params.data;
                @this.set('country_region_id', data.id);
            });

            window.addEventListener('livewire:update', () => {
                $('.select2').select2('destroy'); //destroy the previous instances of select2
                initializeSelect2();
            });

            function initializeSelect2() {

                $('.select2').each(function() {
                    $(this).select2({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                            '100%' : 'style',
                        placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Select',
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                });
            }
        </script>
    @endpush --}}
</div>
