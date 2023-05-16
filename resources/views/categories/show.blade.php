{{-- @extends('layouts.dashboard') --}}
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @include('partials.adminMenu') --}}
            <!-- / Menu -->

            <!-- Layout -->
            <div class="layout-page">

                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">

                            <a class="layout-menu-toggle align-items-xl-center me-xl-0 d-xl-none myColor"
                                href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>

                            <span class="text-muted fw-light">Categories /</span>
                            My Categories
                        </h4>
                        <div class="card">
                            <h5 class="card-header d-flex align-items-center justify-content-between"><span>Categories
                                    Table</span>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create
                                    Category</a>
                            </h5>
                            @if ($categories->isEmpty())
                                <h1 class="card-body">No categories found</h1>
                            @else
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Miniature</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/images/' . $category->image) }}"
                                                            alt="Category Image" class="avatar avatar-lg rounded-circle" />
                                                    </td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <a href="{{ route('dashboard-admin-category-update', $category->id) }}"
                                                            class="text-success">
                                                            <i class="bx bx-edit-alt me-3"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $category->id }}" class="d-inline"
                                                            method="POST"
                                                            action="{{ route('dashboard-admin-categoryDelete', $category->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a onclick="document.getElementById('delete-form-{{ $category->id }}').submit(); return false;"
                                                                class="text-danger cursor-pointer">
                                                                <i class="bx bx-trash me-3"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
            <!-- Layout -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection