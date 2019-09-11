@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Waste</h3>
            <form method="POST" action="{{ route('settings.wastes.update', $waste->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-waste :waste="{{ $waste }}" :categories="{{ $categories }}" :units="{{ $units }}"></edit-waste>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
