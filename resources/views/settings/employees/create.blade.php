@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">New Employee</h3>
            <form style="padding-bottom:35px;" method="POST" action="{{ route('settings.employees.store') }}">
                {{ csrf_field() }}
                <add-employee :areas="{{ $areas }}" :processing-centres="{{ $processingCentres }}"></add-employee>
                @include('layouts.bottom-nav')
            </form>
        </div><!-- end content -->
    </div>
</div>
@endsection
