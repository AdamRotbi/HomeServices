@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Teams</h2>
            </div>
            <div class="pull-right">
                @can('teams-create')
                <a class="btn btn-success" href="{{ route('teams.create') }}"> Create New Team</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Members</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($teams as $team)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $team->name }}</td>
	        <td>{{ $team->members }}</td>
	        <td>
                <form action="{{ route('teams.destroy',$team->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('teams.show',$team->id) }}">Show</a>
                    @can('teams-edit')
                    <a class="btn btn-primary" href="{{ route('teams.edit',$team->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('teams-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $teams->links() !!}


@endsection