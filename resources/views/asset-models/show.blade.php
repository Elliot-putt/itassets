@extends('layouts.app')

@section('title', 'View '.$assetModel->name)

@section('css')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
          integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css"
          integrity="sha512-9h7XRlUeUwcHUf9bNiWSTO9ovOWFELxTlViP801e5BbwNJ5ir9ua6L20tEroWZdm+HFBAWBLx2qH4l4QHHlRyg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View Asset Model</h1>
    <div>
        <a href="{{ route('asset-models.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                class="fas fa-chevron-left fa-sm text-white-50"></i> Back</a>
        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm deleteBtn"><i
                class="fas fa-trash fa-sm text-white-50"></i> Delete</a>
        <a href="{{ route('asset-models.edit', $assetModel->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Edit</a>
        <a href="{{ route('asset-model.showPdf', $assetModel->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
</div>

@if(session('danger_message'))
<div class="alert alert-danger"> {{ session('danger_message')}} </div>
@endif

@if(session('success_message'))
<div class="alert alert-success"> {{ session('success_message')}} </div>
@endif

<section>
    <p class="mb-4">Information regarding Asset Model: {{ $assetModel->name }}, the assets that are currently assigned to the it and any other requested information.</p>

    
    <div class="card shadow h-100 pb-2 m-2" style="border-left: 0.25rem solid 666;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">Asset Model Information</h6>
        </div>
        <div class="card-body">
            <div class="row no-gutters">
                <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                    @if($assetModel->photo()->exists())
                    <img src="{{ asset($assetModel->photo->path) }}" width="100%" alt="{{ $assetModel->name }}" title="{{ $assetModel->name }}">
                    @else
                    <img src="{{ asset('images/svg/device-image.svg') }}" width="100%" alt="{{ $assetModel->name }}" title="{{ $assetModel->name }}">
                    @endif
                </div>
                <div class="col-12 col-sm-8 col-md-9 col-xl-10"">
                    <div class="mb-1">
                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td>{{$assetModel->name}}</td>
                            </tr>
                            <tr>
                                <td>Manufacturer</td>
                                <td>{{$assetModel->manufacturer->name}}</td>
                            </tr>
                            <tr>
                                <td>Model N<sup>o</sup></td>
                                <td>{{$assetModel->model_no}}</td>
                            </tr>
                            <tr>
                                <td>Depreciation Model</td>
                                <td>{{$assetModel->depreciation->name}}</td>
                            </tr>
                            <tr>
                                <td>EOL</td>
                                <td>{{$assetModel->eol}} Months</td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow h-100 pb-2 m-2" style="border-left: 0.25rem solid 666;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">Assigned Assets</h6>
        </div>
        <div class="card-body">
            <table id="assetsTable" class="table table-striped">
                <thead>
                <tr>
                    <th class="col-9 col-md-2"><small>Item</small></th>
                    <th class="col-1 col-md-auto"><small>Location</small></th>
                    <th class="col-1 col-md-auto"><small>Tag</small></th>
                    <th class="d-none d-xl-table-cell"><small>Date</small></th>
                    <th class="d-none d-xl-table-cell"><small>Cost</small></th>
                    <th class="d-none d-xl-table-cell"><small>Supplier</small></th>
                    <th class="col-auto d-none d-xl-table-cell"><small>Warranty (M)</small></th>
                    <th class="col-auto text-center d-none d-md-table-cell"><small>Audit Due</small></th>
                    <th class="text-right col-1"><small>Options</small></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th><small>Item</small></th>
                    <th><small>Location</small></th>
                    <th><small>Tag</small></th>
                    <th class=" d-none d-xl-table-cell"><small>Date</small></th>
                    <th class=" d-none d-xl-table-cell"><small>Cost</small></th>
                    <th class=" d-none d-xl-table-cell"><small>Supplier</small></th>
                    <th class=" d-none d-xl-table-cell"><small>Warranty (M)</small></th>
                    <th class="text-center  d-none d-md-table-cell"><small>Audit Due</small></th>
                    <th class="text-right col-1"><small>Options</small></th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($assetModel->assets as $asset)
                    <tr>
                        <td>{{ $assetModel->name ?? 'No Model'}}<br><small
                                class="d-none d-md-inline-block">{{ $asset->serial_no }}</small></td>
                        <td class="text-center" data-sort="{{ $asset->location->name ?? 'Unnassigned'}}">
                            @if($asset->location->photo()->exists())
                                <img src="{{ asset($asset->location->photo->path)}}" height="30px"
                                      alt="{{$asset->location->name}}"
                                      title="{{ $asset->location->name ?? 'Unnassigned'}}"/>
                            @else
                                {!! '<span class="display-5 font-weight-bold btn btn-sm rounded-circle text-white" style="background-color:'.strtoupper($asset->location->icon ?? '#666').'">'
                                    .strtoupper(substr($asset->location->name ?? 'u', 0, 1)).'</span>' !!}
                            @endif
                        </td>
                        <td>{{ $asset->asset_tag }}</td>
                        <td class="d-none d-md-table-cell"
                            data-sort="{{ strtotime($asset->purchased_date)}}">{{ \Carbon\Carbon::parse($asset->purchased_date)->format('d/m/Y')}}</td>
                        <td class="text-center  d-none d-xl-table-cell">
                            £{{ $asset->purchased_cost }}
                           
                        </td>
                        <td class="text-center d-none d-xl-table-cell">{{$asset->supplier->name ?? "N/A"}}</td>
                        @php $warranty_end = \Carbon\Carbon::parse($asset->purchased_date)->addMonths($asset->warranty);@endphp
                        <td class="text-center  d-none d-xl-table-cell" data-sort="{{ $warranty_end }}">
                            {{ $asset->warranty }} Months

                            <br><small>{{ round(\Carbon\Carbon::now()->floatDiffInMonths($warranty_end)) }}
                                Remaining</small>
                        </td>
                        <td class="text-center d-none d-xl-table-cell"
                            data-sort="{{ strtotime($asset->audit_date)}}">
                            @if(\Carbon\Carbon::parse($asset->audit_date)->isPast())
                                <span
                                    class="text-danger">{{\Carbon\Carbon::parse($asset->audit_date)->format('d/m/Y') }}</span>
                                <br><small>Audit Overdue</small>
                            @else
                                <?php $age = Carbon\Carbon::now()->floatDiffInDays($asset->audit_date);?>
                                @switch(true)
                                    @case($age < 31) 
                                        <span class="text-warning">{{ \Carbon\Carbon::parse($asset->audit_date)->format('d/m/Y') }}</span>
                                        <br><small>Audit Due Soon</small>
                                        @break
                                    @default
                                        <span class="text-secondary">{{ \Carbon\Carbon::parse($asset->audit_date)->format('d/m/Y') }}</span>
                                        <br><small>Audit due in {{floor($age)}} days</small>
                                @endswitch
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="dropdown no-arrow">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                   id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div
                                    class="dropdown-menu text-right dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Asset Options:</div>
                                    <a href="{{ route('assets.show', $asset->id) }}"
                                       class="dropdown-item">View</a>
                                    @can('edit', $asset)
                                        <a href="{{ route('assets.edit', $asset->id) }}" class="dropdown-item">Edit</a>
                                    @endcan
                                    @can('delete', $asset)
                                        <form id="form{{$asset->id}}"
                                              action="{{ route('assets.destroy', $asset->id) }}" method="POST"
                                              class="d-block p-0 m-0">
                                            @csrf
                                            @method('DELETE')
                                            <a class="deleteBtn dropdown-item" href="#"
                                               data-id="{{$asset->id}}">Delete</a>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
</section>

@endsection

@section('modals')

<!-- User Delete Modal-->
<div class="modal fade bd-example-modal-lg" id="removeLocationModal" tabindex="-1" role="dialog"
    aria-labelledby="removeLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLocationModalLabel">Are you sure you want to delete this Location?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="location-id" type="hidden" value="{{ $assetModel->id }}">
                <p>Select "Delete" to remove this location from the system.</p>
                <small class="text-danger">**Warning this is permanent. All assets assigned to this location will become
                    available.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="button" id="confirmBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
            $('#assetsTable').DataTable({
                "autoWidth": false,
                "pageLength": 25,
                "columnDefs": [{
                    "targets": [9],
                    "orderable": false
                }],
                "order": [[1, "asc"]],
            });
        });
</script>

@endsection