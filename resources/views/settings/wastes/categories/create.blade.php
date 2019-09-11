@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">New Waste Category</h3>
            <form method="POST" action="{{ route('settings.categories.store') }}">
                {{ csrf_field() }}
                <add-waste-category></add-waste-category>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
