@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->role === 'driver')
        <driver-home :driver="{{ Auth::user() }}"></driver-home>
    @elseif(Auth::user()->role === 'administrator')
        <admin-home v-if="{{ Auth::user()->role === 'administrator' }}"></admin-home>    
    @endif
</div>
@endsection
