@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">New Processing Centre</h3>
            <form method="POST" action="{{ route('settings.processing-centres.store') }}">
                {{ csrf_field() }}
                <add-processing-centre></add-processing-centre>
                @include('layouts.bottom-nav')
            </form>
        </div><!-- end content -->
    </div>
</div>
@endsection
