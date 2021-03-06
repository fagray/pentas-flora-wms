@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Employee</h3>
            <form method="POST" action="{{ route('settings.employees.update', $employee->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-employee :areas="{{ $areas }}" :employee="{{ $employee }}"></edit-employee>
                @include('layouts.bottom-nav')
            </form>
        </div><!-- end content -->
    </div>
</div>
@endsection
