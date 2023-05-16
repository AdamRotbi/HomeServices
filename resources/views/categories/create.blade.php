{{-- @extends('layouts.dashboard') --}}
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @include('partials.adminMenu') --}}
            <!-- / Menu -->

            <!-- Layout container -->
            {{-- <div class="layout-page"> --}}
                <!-- Navbar -->


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <a class="layout-menu-toggle align-items-xl-center me-xl-0 d-xl-none myColor"
                                href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                            <span class="text-muted fw-light">Categories /</span>
                            Create Category
                        </h4>

                        <div class="row">
                            <form class="col-md-12" method="POST" action="{{ route('categories.createCategory') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header">Create Category</h5>
                                    <!-- Account -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="{{ asset('img/image-placeholder.jpg') }}" alt="user-avatar"
                                                class="d-block rounded" height="100" id="categoryUploadedImageCreate"
                                                width="130" />
                                            <div class="button-wrapper">
                                                <label for="categoryImageUploadCreate" class="btn btn-primary me-2 mb-4"
                                                    tabindex="0">
                                                    <span class="d-none d-sm-block">Upload category miniature</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" class="account-file-input"
                                                        id="categoryImageUploadCreate" name="image" hidden />
                                                </label>
                                                <button type="reset"
                                                    class="btn btn-outline-secondary account-image-reset mb-4">
                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Reset</span>
                                                </button>
                                                <p class="text-muted mb-0">Allowed JPG, JPEG or PNG</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <div id="formAccountSettings">
                                            <div class="row">
                                                <div class="mb-3 col-md-12">
                                                    <label for="category_name" class="form-label">Category
                                                        Name</label>
                                                    <input class="form-control" type="text" id="category_name"
                                                        name="name" placeholder="Ex: Shoes" value="{{ old('name') }}"
                                                        autofocus />
                                                </div>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                            <div class="my-1">
                                                                {{ $error }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection