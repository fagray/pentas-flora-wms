@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="page-header">New Job Order</h3>
    <form method="POST"
          action="{{ route('jobs.store') }}">
        {{ csrf_field() }}
        <add-job :pricelists="{{ $pricelists }}"
                 :customers="{{ $customers }}"></add-job>
    </form>
</div>
@endsection