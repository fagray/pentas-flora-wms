@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.vehicles.create') }}"
                   class="btn btn-primary">New Vehicle</a>
            </div>
            <h3 class="page-header">Vehicles</h3>
            <vehicles></vehicles>
        </div>
    </div>
</div>
@endsection