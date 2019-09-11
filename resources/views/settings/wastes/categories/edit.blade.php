@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.settings.sidebar')

        <div class="col-md-8">
            <h3 class="page-header">Edit Waste Category</h3>
            <form method="POST" action="{{ route('settings.categories.update', $category->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <edit-waste-category :category="{{ $category }}" :sub-categories="{{ $subCategories }}"></edit-waste-category>
                @include('layouts.bottom-nav')
            </form>
            
            
        </div><!-- end content -->
    </div>
</div>
@endsection
