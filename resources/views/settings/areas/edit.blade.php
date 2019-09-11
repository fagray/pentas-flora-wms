@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Area</h3>
            <form method="POST" action="{{ route('settings.areas.update', $area->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-area :area="{{ $area }}"></edit-area>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
