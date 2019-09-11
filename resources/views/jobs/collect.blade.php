@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="page-header">Record Job Collection</h3>
    <form method="POST" enctype="multipart/form-data" 
          action="{{ route('jobs.collection.store',$job->id) }}">
        {{ csrf_field() }}
        <record-collection :job="{{ $job }}"> </record-collection>
        @include('layouts.bottom-nav')
    </form>
    
</div>
@endsection