@extends('layouts.app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Laravel 10 CRUD with Image Upload Example from scratch - ItSolutionStuff.com</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
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
        <th>Image</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($categories as $cat)
    <tr>
        <td>{{ ++$i }}</td>
        <td><img src="/cimages/{{ $cat->image }}" width="100px"></td>
        <td>{{ $cat->name }}</td>
    
        <td>
            <form action="{{route('categories.destroy',$cat->id) }}" method="POST">
 
                <a class="btn btn-info" href="{{ route('categories.show',$cat->id) }}">Show</a>
  
                <a class="btn btn-primary" href="{{ route('categories.edit',$cat->id) }}">Edit</a>
 
                @csrf
                @method('DELETE')
    
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $categories->links() !!}
    
@endsection