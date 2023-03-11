@extends('layouts.app')

@push('plugins')
    {!! NoCaptcha::renderJs() !!}
@endpush

@section('content')
    <section
        style="min-height: 100vh; background-image: linear-gradient(270deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.2) 100%))">
        En construccion
    </section>

@endsection
