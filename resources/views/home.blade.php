@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center service-container">
            @if(!empty($services))
            @foreach($services as $service)
            <div class="col-md-4 service-content" style="margin-top: 15px;" id="service_cart_{{$service->id}}" data-id="{{$service->id}}">
                <div class="card">
                    <div class="card-header">{{$service->name}}</div>
                    <div class="card-body">
                        <a href="#" style="float: left;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-filter-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path fill-rule="evenodd" d="M6 11.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg></a>
                        <div style="float: left;">{{$service->description}}</div>
                        <div class="input-group-prepend" style="float: right;">
                            <div class="input-group-text">
                                <input type="checkbox" name="service_choose[]" id="service_choose_{{$service->id}}" class="service-checkbox" onclick="checkAvailability(this,{{$service->id}})">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                <p class="alert alert-border">Services not available yet</p>
            @endif
        </div>
    </div>
    </div>
@endsection
