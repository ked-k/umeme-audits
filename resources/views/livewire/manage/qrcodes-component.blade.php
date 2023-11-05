<div>
    @section('title', 'visas')
    @include('livewire.layouts.partials.inc.create-resource')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">                
                    <div class="card-body">

                        <x-table-utilities>
                            <div class="d-flex align-items-center ml-4 col-md-3">
                                <label for="orderBy" class="form-label text-nowrap mr-2 mb-0">OrderBy</label>
                                <select wire:model="orderBy" class="form-control">
                                    <option type="created_at">date</option>
                                    <option type="id">Latest</option>
                                </select>
                            </div>
                        </x-table-utilities>

                        <div class="tab-content">
                            <div class="table-responsive">
                                <table id="datableButton" class="table table-borderedtable-bordered table-striped mb-0 w-100 sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Date from') }}</th>
                                            <th>{{ __('Date To') }}</th>
                                            <th>{{ __('code') }}</th>
                                            <th>{{ __('Contact') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chinavisas as $key => $type)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $type->date_from }}</td>
                                                <td>{{ $type->date_to }}</td>
                                                <td>{{ $type->code }}</td>
                                                <td>{{ $type->contact }}</td>
                                                <td>{{ $type->is_active }}</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-ico text-success mx-1 "
                                                        data-toggle="modal" wire:click="editData({{ $type->id }})"
                                                        data-target="#addnew"><i class="fa fa-edit"></i></a>
                                                        <a href="javascript: void(0);" class="action-ico text-success mx-1 "
                                                        data-toggle="modal"  wire:click="$set('code','{{ $type->code }}')"
                                                        data-target="#viewcode"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="btn-group float-end">
                                        {{ $districts->links('vendor.livewire.bootstrap') }}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div>
            </div>
        </div>
    </div>
    
    <div wire:ignore.self class="modal fade" id="viewcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('New Visa') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                @php
                    $link = route('viewVisa', ['id' => $code]);
                @endphp
                {!! QrCode::size(100)->margin(1)->generate($link) !!}
               
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('New Visa') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form @if ($mode == 'edit') wire:submit.prevent="updateData" @else  wire:submit.prevent="storeData" @endif>
                    <div class="modal-body">
                       
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" id="countryName" class="form-control" name="contact" required wire:model.lazy="contact">
                                @error('contact')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="contact" class="form-label">Days</label>
                                <input type="number" id="no_days" class="form-control" name="no_days" required wire:model.lazy="no_days">
                                @error('no_days')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="contact" class="form-label">People</label>
                                <input type="number" id="actors" class="form-control" name="actors" required wire:model.lazy="actors">
                                @error('actors')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">From</label>
                                <input type="date" id="no_days" class="form-control" name="no_days" required wire:model.lazy="date_from">
                                @error('date_from')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">To</label>
                                <input type="date" id="date_to" class="form-control" name="date_to" required wire:model.lazy="date_to">
                                @error('no_days')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="is_active" class="form-label">Status</label>
                              <select name="is_active" class="form-control form-control" wire:model.differ='is_active' id="is_active">
                                <option value="">Select...</option>
                                <option value="1">Active</option>
                                <option value="0">Disabaled</option>
                              </select>
                                @error('is_active')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                     
                    </div>                

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            window.addEventListener('close-modal', event => {
                $('#addnew').modal('hide');
                $('#delete_modal').modal('hide');
                $('#show-delete-confirmation-modal').modal('hide');
            });
            window.addEventListener('delete-modal', event => {
                $('#delete_modal').modal('show');
            });
        </script>
    @endpush
</div>
