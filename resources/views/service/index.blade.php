@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('services.create') }}"> Create New Service</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Service Name</th>
            <th scope="col">Service Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($services as $service)
        <tr>
            <th scope="row">{{$service->id}}</th>
            <td>{{$service->name}}</td>
            <td>{{$service->description}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $services->links() !!}
@endsection