@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <x-alert type="success" />
    <x-alert type="info" />

    <a href="{{ route('dashboard.products.create') }}" class="mr-4">
        <button type="submit" class="btn btn-sm btn-outline-primary mb-4">Create</button>
    </a>

    {{-- <form action="{{ URL::current() }}" method="get">
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
    </form> --}}

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">store_id</th>
                <th scope="col">category_id</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                            @csrf
                            <!-- Form method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Products defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}

@endsection

@push('script')
    <script src="{{ asset('dist/js/alert.js') }}"></script>
@endpush
