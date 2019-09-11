@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">New Waste Item</h3>
            <form method="POST" action="{{ route('settings.wastes.store') }}">
                {{ csrf_field() }}
                <add-waste :units="{{ $units }}" :categories="{{ $categories }}"></add-waste>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
