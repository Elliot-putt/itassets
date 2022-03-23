@extends('layouts.app')

@section('title', 'View '.$user->name)


@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View User</h1>
        <div>
            <form id="form{{$user->id}}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                @can('viewAll' , \App\Models\User::class)

                    <a href="{{ route('users.index')}}"
                       class="d-none d-sm-inline-block btn btn-sm btn-grey shadow-sm"><i
                            class="fas fa-chevron-left fa-sm text-white-50"></i> Back</a>
                @endcan
                @can('forceDelete' , $user)

                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-coral shadow-sm deleteBtn"
                       data-id="{{$user->id}}"><i class="fas fa-trash fa-sm text-white-50 "></i> Delete</a>
                @endcan
                @csrf
                @method('DELETE')
                @can('update' , $user)
                    <a href="{{ route('users.edit', $user->id)}}"
                       class="d-none d-sm-inline-block btn btn-sm btn-yellow shadow-sm"><i
                            class="fas fa-plus fa-sm text-white-50"></i> Edit</a>
                @endcan
                <a href="{{ route('user.showPdf', $user->id)}}"
                   class="d-none d-sm-inline-block btn btn-sm btn-blue shadow-sm loading"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </form>
        </div>
    </div>

    @if(session('danger_message'))
        <div class="alert alert-danger"> {!! session('danger_message')!!} </div>
    @endif

    @if(session('success_message'))
        <div class="alert alert-success"> {!! session('success_message')!!} </div>
    @endif

    <section>
        <p class="mb-4">Information regarding {{ $user->name }}, the assets that are currently assigned to the location
                        and any request information.</p>

        <div class="row auto-width m-auto">
            <div class="col-12 mb-4">
                <div class="card shadow h-100 pb-2">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">User Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3 ">
                                @if($user->photo()->exists())
                                    <img src="{{asset($user->photo->path)?? ''}}"
                                         alt="{{ $user->name.' Profile Image'}}" class="img-responsive" width="100%">
                                @else
                                    <img src="{{ asset('images/profile.png')}}" alt="{{ $user->name.' Profile Image'}}"
                                         class="img-responsive" width="100%">
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-9">
                                <h3>{{ $user->name }}</h3>
                                {{$user->role->name}}
                                <p>
                                    @if($user->email != "")
                                        <a href="mailto:{{$user->email}}">{{$user->email}}</a><br>
                                    @endif
                                    @if($user->telephone != "")
                                        {{$user->telephone}}</p>
                                @endif
                                @if($location)
                                    <p>{{$location->name}}<br>
                                        {{ $location->address_1 }}<br>
                                        @if($location->address_2 != "")
                                            {{ $location->address_2 }}<br>
                                        @endif
                                        {{ $location->city }}<br>
                                        {{ $location->postcode }}
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card shadow h-100 pb-2">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Permissions</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $locations = $user->locations;
                        @endphp
                        @foreach($locations as $location)
                            <small data-bs-toggle="tooltip" data-html="true" data-bs-placement="left"
                                   title="{{ $location->name }}<br>{{ $location->address1}}"
                                   class="rounded p-1 m-1 mb-2 text-white d-inline-block pointer"
                                   style="background-color: {{$location->icon}}">{{$location->name}}</small>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                         data-bs-toggle="collapse" data-bs-target="#changes" aria-expanded="false"
                         aria-controls="changes">
                        <h6 class="m-0 font-weight-bold">Account Changes</h6>
                    </div>
                    <div class="card-body collapse" id="changes">
                        <table class="logs table table-striped ">
                            <thead>
                            <tr>
                                <th class="col-1">Log ID</th>
                                <th class="col-7 text-center">Data</th>
                                <th class="col-2    text-center">User</th>
                                <th class="col-2 text-center">Date</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Log ID</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Date</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @php($logs = $user->logs()->orderBy('created_at', 'desc')->get())
                            @foreach($logs as $log)
                                <tr>
                                    <td class="text-center">{{ $log->id }}</td>
                                    <td class="text-left">{{$log->data}}</td>
                                    <td class="text-left">{{ $log->user->name ?? 'Unkown'}}</td>
                                    <td class="text-right"
                                        data-sort="{{ strtotime($log->created_at)}}">{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y h:i:s')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                         data-bs-toggle="collapse" data-bs-target="#activity" aria-expanded="false"
                         aria-controls="activity">
                        <h6 class="m-0 font-weight-bold">Recent Activity</h6>
                    </div>
                    <div class="card-body collapse" id="activity">
                        <table class="logs table table-striped">
                            <thead>
                            <tr>
                                <th class="col-1">Log ID</th>
                                <th class="col-1 text-center">Type</th>
                                <th class="col-7 text-center">Data</th>
                                <th class="col-3 text-center">Date</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Log ID</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Date</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @php($activities = $user->activity()->orderBy('id', 'desc')->get())
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td class="text-left">{{$activity->loggable_type}}</td>
                                    <td class="text-left">{{ $activity->data }}</td>
                                    <td class="text-left"
                                        data-sort="{{ strtotime($activity->created_at)}}">{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y h:i:s')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('modals')

    <x-modals.delete :archive="true"/>

@endsection

@section('js')
    <script src="{{ asset('js/delete.js') }}"></script>


@endsection
