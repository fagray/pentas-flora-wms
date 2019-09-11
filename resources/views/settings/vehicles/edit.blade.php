@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Vehicle</h3>
            <form method="POST" action="{{ route('settings.vehicles.update', $vehicle->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-vehicle :vehicle="{{ $vehicle }}"></edit-vehicle>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
