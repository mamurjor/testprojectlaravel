@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container mt-4">
        <h2>Menus</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Search Form --}}
        <form method="GET" action="{{ route('menus.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by Title or Slug"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <a href="{{ route('menus.create') }}" class="btn btn-success mb-3">Create Menu</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Order</th>
                    <th>Icon</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->title }}</td>
                        <td>{{ $menu->slug ?? '-' }}</td>
                        <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                        <td>{{ $menu->order }}</td>
                        <td>{!! $menu->icon ? "<i class='{$menu->icon}'></i>" : '-' !!}</td>
                        <td>{{ $menu->class ?? '-' }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Submenus --}}
                    @if ($menu->children && $menu->children->count() > 0)
                        @foreach ($menu->children as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>— {{ $child->title }}</td>
                                <td>{{ $child->slug ?? '-' }}</td>
                                <td>{{ $menu->title }}</td>
                                <td>{{ $child->order }}</td>
                                <td>{!! $child->icon ? "<i class='{$child->icon}'></i>" : '-' !!}</td>
                                <td>{{ $child->class ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('menus.edit', $child->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('menus.destroy', $child->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                @empty
                    <tr>
                        <td colspan="8" class="text-center">No menus found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $menus->withQueryString()->links() }}
    </div>
@endsection
