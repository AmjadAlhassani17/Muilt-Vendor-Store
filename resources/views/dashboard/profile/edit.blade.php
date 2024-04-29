@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post">
        @csrf
        @method('PATCH')

        <x-alert type="success"/>

        @include('dashboard.profile._form')
    </form>
@endsection

@push('script')
    <script src="{{ asset('dist/js/alert.js') }}"></script>
@endpush
