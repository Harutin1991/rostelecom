@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('Services List') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Edit {{ $service->name }}
            </li>
        </ol>
    </nav>


    <form method="POST" action="{{ route('services.update',['service'=>$service]) }}">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ $service->name }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                          name="description" required>{{ $service->description }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        @if (!empty($connectedServicesIds))
            <div class="form-group row">
                <label for="email"
                       class="col-md-4 col-form-label text-md-right">{{ __('Select Connected Services') }}</label>
                <div class="col-md-6">
                    <select name="connected_services_id[]" class="form-control" id="connected_services_id"
                            multiple="multiple">
                        @foreach ($services as $service)
                            <option value="{{$service->id}}" <?php if(in_array($service->id,$connectedServicesIds)):?>selected<?php endif;?>>{{$service->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Edit') }}
                </button>
            </div>
        </div>
    </form>
@endsection