@extends('layouts.pdf-reports')

@section('title', 'Users  Report')

@section('page', 'Users')

@section('user', $user->name)

@section('content')
    <table id="assetsTable" width="100%">
        <thead>
        <tr>
            <th width="5%;">ID</th>
            <th width="15%;">Photo</th>
            <th width="15%;">Name</th>
            <th width="15%;">Email</th>
            <th width="10%;">Role</th>
            <th width="40%;">Permissions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $admin)
            <tr>
                <td class="text-center">{{ $admin->id }}</small></td>
                <td class="text-center">
                    @if($photo = \App\Models\Photo::find($asset->photo_id))
                    <span>{{$photo->name ?? 'Unassigned'}}</span>
                    @else
                       {{ 'Unallocated'}} 
                    @endif
                </td>
                <td align="left">{{ $admin->name}}</td>
                <td class="text-left">{{ $admin->email ?? 'N/A' }}</td>
                <td class="text-center">
                    @php
                    switch($admin->role_id){
                        case 0:
                            echo '<small class="text-danger">No Access</small>';
                            break;
                        case 1:
                            echo '<small class="text-info">Super Admin</small>';
                            break;
                        case 2:
                            echo '<small class="text-warning">Administrator</small>';
                            break;
                        case 3:
                            echo '<small class="text-success">User Manager</small>';
                            break;
                        case 4:
                            echo '<small class="text-secondary">User</small>';
                            break;
                    }

                    @endphp
                </td>
                <td class="text-center align-top">
                    @php
                        if($admin->role_id == 1){
                            $locations = App\Models\Location::all();
                        }else{
                            $locations = $user->locations;
                        }
                        @endphp
                        @foreach($locations as $location)
                        <small style="color: {{$location->icon}}">{{$location->name}}</small>
                        @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th width="5%;">ID</th>
                <th width="15%;">Photo</th>
                <th width="15%;">Name</th>
                <th width="15%;">Email</th>
                <th width="10%;">Role</th>
                <th width="40%;">Permissions</th>
            </tr>
        </tfoot>
    </table>
@endsection
