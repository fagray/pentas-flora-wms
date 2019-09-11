@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <div class="float-right">
                <a href="{{ route('settings.wastes.create') }}"
                   class="btn btn-primary">New Waste</a>
                <a href="{{ route('settings.categories.create') }}"
                   class="btn btn-primary">New Category</a>
            </div>
            <h3 class="page-header">Waste Items</h3>
            <wastes></wastes>
        </div>
    </div>
</div>
@endsection