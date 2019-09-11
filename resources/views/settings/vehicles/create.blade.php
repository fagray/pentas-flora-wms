@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="page-header">New Vehicle</h3>
            <form method="POST" action="{{ route('settings.vehicles.store') }}">
                {{ csrf_field() }}
                <add-vehicle></add-vehicle>
                @include('layouts.bottom-nav')
            </form>
        </div><!-- end content -->
        
    </div>
</div>
@endsection
