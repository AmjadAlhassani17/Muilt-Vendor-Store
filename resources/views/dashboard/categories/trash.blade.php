@extends('layouts.dashboard')

@section('title', 'Trashed Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <x-alert type="success" />

    <a href="{{ route('dashboard.categories.index') }}" class="mr-4">
        <button type="submit" class="btn btn-sm btn-outline-primary mb-4">Back</button>
    </a>

    <form action="{{ URL::current() }}" method="get">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name..." value="{{ request('name') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <select name="status" class="form-control" aria-label="Select option">
                            <option value="">All</option>
                            <option value="active" @selected(request('status') == 'active')>Active</option>
                            <option value="archive" @selected(request('status') == 'archive')>Archive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>
            </div>
        </div>
    </form>



    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#Image</th>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Deleted At</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th><img src="{{ asset('storage/' . $category->image)}}" alt="" height="50"></th>
                    <th>{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore' , $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                            @csrf
                            <!-- Form method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Force-Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Categories defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}

@endsection

@push('script')
    <script src="{{ asset('dist/js/alert.js') }}"></script>
@endpush
