@extends('layouts.dashboard')

@section('title', 'Create Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        @include('dashboard.categories._form')
    </form>
@endsection
