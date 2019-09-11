@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="page-header">Assign Job Order</h3>
    <form method="POST"
          action="{{ route('jobs.assign.store', $job->id) }}">
        {{ csrf_field() }}
        {{-- <assign-job :job="{{ $job }}" :vehicles="{{ $vehicles }}"> </assign-job> --}}
        @include('layouts.bottom-nav')
    </form>
</div>
@endsection