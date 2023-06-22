<div>
    @section('title', 'Requests')
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
                                    <option type="created_at">Name</option>
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
                                            <th>{{ __('Key Type') }}</th>
                                            <th>{{ __('Feeder') }}</th>
                                            <th>{{ __('Location') }}</th>
                                            <th>{{ __('Box Number') }}</th>
                                            <th>{{ __('Padlock Number') }}</th>
                                            <th>{{ __('Hook No') }}</th>
                                            <th>{{ __('Requested By') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($key_requests as $key => $keycont)
                                        <tr @if ($keycont->status != 'Available') class="text-warning" @endif>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $keycont->key->type }}</td>
                                                <td>{{ $keycont->key->feeder }}</td>
                                                <td>{{ $keycont->key->location }}</td>
                                                <td>{{ $keycont->key->box_no??'N/A' }}</td>
                                                <td>{{ $keycont->key->padlock_no }}</td>
                                                <td>{{ $keycont->key->hook_no }}</td>
                                                <td>{{ $keycont->user->name }}</td>
                                                <td>{{ $keycont->status }}</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-ico text-success mx-1 "
                                                        data-toggle="modal" wire:click="editData({{ $keycont->id }})"
                                                        data-target="#addnew"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="btn-group float-end">
                                        {{ $key_requests->links('vendor.livewire.bootstrap') }}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div>
            </div>
        </div>
    </div>
    
    <div wire:ignore.self class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('New Key') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                
                <form @if ($mode == 'edit') wire:submit.prevent="updateData" @else  wire:submit.prevent="storeData" @endif>
                    <div class="modal-body">
                       
                        <div class="row">
                        
                            <div class="mb-3 col-md-12">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" id="location" class="form-control" name="location" required wire:model.defer="location">
                                @error('location')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="box_no" class="form-label">Box number</label>
                                <input type="text" id="box_no" class="form-control" name="box_no" required wire:model.defer="box_no">
                                @error('box_no')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="hook_no" class="form-label">Hook number</label>
                                <input type="text" id="meter_number" class="form-control" name="hook_no" required wire:model.defer="hook_no">
                                @error('hook_no')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>    
                            <div class="mb-3 col-md-12">
                                <label for="hook_no" class="form-label">Padlock number</label>
                                <input type="text" id="padlock_no" class="form-control" name="padlock_no" required wire:model.lazy="padlock_no">
                                @error('padlock_no')
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
