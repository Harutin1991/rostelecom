@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('services.create') }}"> Create New Service</a>
            </div>
        </div>
    </div>

    @if (Session::get('messageType') == 1)
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    @elseif(Session::get('success') == 2)
        <div class="alert alert-danger">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Service Name</th>
            <th scope="col">Service Description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($services as $service)
        <tr>
            <th scope="row">{{$service->id}}</th>
            <td>{{$service->name}}</td>
            <td>{{$service->description}}</td>
            <td>
                <a href="{{route('services.edit',['service'=>$service])}}" class="btn btn-success">Edit</a>
                <form action="{{ route('services.destroy',['service'=>$service]) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $services->links() !!}
@endsection