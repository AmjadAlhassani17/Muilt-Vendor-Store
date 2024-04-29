@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <x-alert type="success" />
    <x-alert type="info" />

    <a href="{{ route('dashboard.categories.create') }}" class="mr-4">
        <button type="submit" class="btn btn-sm btn-outline-primary mb-4">Create</button>
    </a>

    <a href="{{ route('dashboard.categories.trash') }}" class="mr-4">
        <button type="submit" class="btn btn-sm btn-outline-dark mb-4">Trash</button>
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
                <th scope="col">Parent</th>
                <th scope="col">Status</th>
                <th scope="col">Products Count</th>
                <th scope="col">Created At</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th><img src="{{ asset('storage/' . $category->image)}}" alt="" height="50"></th>
                    <th>{{ $category->id }}</th>
                    <td><a href="{{ route('dashboard.categories.show' , $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            <!-- Form method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Categories defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}

@endsection

@push('script')
    <script src="{{ asset('dist/js/alert.js') }}"></script>
@endpush
