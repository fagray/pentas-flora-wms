@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.areas.create') }}" class="btn btn-primary" >New Area</a>
            </div>
            <h3 class="page-header">Areas</h3>
            <areas></areas>
        </div>
    </div>
</div>
@endsection
