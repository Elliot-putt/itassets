@extends('layouts.app')

@section('title', 'Consumables Recycle Bin')


@section('content')


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consumables | Recycle Bin</h1>
        <div>
            <a href="{{ route('consumables.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                    class="fas fa-chevron-left fa-sm text-white-50"></i> Back</a>
            <a href="{{ route('documentation.index')."#collapseSixRecycleBin"}}"
               class="d-none d-sm-inline-block btn btn-sm  bg-yellow shadow-sm"><i
                    class="fas fa-question fa-sm text-dark-50"></i> Recycle Bin Help</a>
            @can('generatePDF', \App\Models\Consumable::class)
                @if ($consumables->count() != 1)
                    <form class="d-inline-block" action="{{ route('consumables.pdf')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ json_encode($consumables->pluck('id'))}}" name="consumables"/>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-blue shadow-sm"><i
                                class="fas fa-file-pdf fa-sm text-white-50"></i> Generate Report
                        </button>
                    </form>
                @endif
            @endcan
        </div>
    </div>

    <x-handlers.alerts/>

    <section>
        <p class="mb-4">Below are the different Consumables stored in the management system. Each has
                        different options and locations can created, updated, and deleted.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th><small>Name</small></th>
                            <th class="text-center"><small>Location</small></th>
                            <th class="text-center"><small>Manufacturers</small></th>
                            <th><small>Date</small></th>
                            <th><small>Cost</small></th>
                            <th><small>Supplier</small></th>
                            <th class="text-center"><small>Status</small></th>
                            <th class="text-center"><small>Warranty</small></th>
                            <th class="text-right"><small>Options</small></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><small>Name</small></th>
                            <th class="text-center"><small>Location</small></th>
                            <th class="text-center"><small>Manufacturers</small></th>
                            <th><small>Purchased Date</small></th>
                            <th><small>Purchased Cost</small></th>
                            <th><small>Supplier</small></th>
                            <th class="text-center"><small>Status</small></th>
                            <th class="text-center"><small>Warranty</small></th>
                            <th class="text-right"><small>Options</small></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($consumables as $consumable)

                            <tr>
                                <td>{{$consumable->name}}
                                    <br>
                                    <small>{{$consumable->serial_no}}</small>
                                </td>
                                <td class="text-center">
                                    @if($consumable->location->photo()->exists())
                                        <img src="{{ asset($consumable->location->photo->path)}}" height="30px"
                                             alt="{{$consumable->location->name}}"
                                             title="{{ $consumable->location->name ?? 'Unnassigned'}}"/>
                                    @else
                                        {!! '<span class="display-5 font-weight-bold btn btn-sm rounded-circle text-white" style="background-color:'.strtoupper($consumable->location->icon ?? '#666').'">'
                                            .strtoupper(substr($consumable->location->name ?? 'u', 0, 1)).'</span>' !!}
                                    @endif
                                </td>
                                <td class="text-center">{{$consumable->manufacturer->name ?? "N/A"}}</td>
                                <td data-sort="{{ $consumable->purchased_date}}">{{\Carbon\Carbon::parse($consumable->purchased_date)->format("d/m/Y")}}</td>
                                <td>£{{$consumable->purchased_cost}}</td>
                                <td>{{$consumable->supplier->name ?? 'N/A'}}</td>
                                <td class="text-center" style="color: {{$consumable->status->colour ?? '#666'}};">
                                    <i class="{{$consumable->status->icon ?? 'fas fa-circle'}}"></i> {{ $consumable->status->name ?? 'N/A' }}
                                </td>
                                @php $warranty_end = \Carbon\Carbon::parse($consumable->purchased_date)->addMonths($consumable->warranty);@endphp
                                <td class="text-center  d-none d-xl-table-cell" data-sort="{{ $warranty_end }}">
                                    {{ $consumable->warranty }} Months

                                    <br><small>{{ round(\Carbon\Carbon::now()->floatDiffInMonths($warranty_end)) }}
                                        Remaining</small></td>
                                <td class="text-right">
                                    <div class="dropdown no-arrow">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                           id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div
                                            class="dropdown-menu text-right dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Consumable Options:</div>
                                            <a href="{{ route('consumables.restore', $consumable->id) }}"
                                               class="dropdown-item">Restore</a>
                                            <form class="d-block" id="form{{$consumable->id}}"
                                                  action="{{ route('consumables.remove', $consumable->id) }}"
                                                  method="POST">
                                                @csrf
                                                @can('delete', $consumable)
                                                    <a class="deleteBtn dropdown-item" href="#"
                                                       data-id="{{$consumable->id}}">Delete</a>
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <x-paginate :model="$consumables"/>
                </div>
            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-body">
                <h4>Help with Consumables</h4>
                <p>This area can be minimised and will contain a little help on the page that the consumable is
                   currently
                   on.</p>
            </div>
        </div>

    </section>

@endsection

@section('modals')
    <x-modals.delete :archive="true"/>

@endsection

@section('js')
    <script src="{{asset('js/delete.js')}}"></script>
@endsection
