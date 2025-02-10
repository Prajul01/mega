@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
@endpush
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                {{ $about->who_we_are_heading }}
                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        <a href="{{ route('admin.about.first_form') }}" class="btn btn-sm btn-outline-info"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                {{ $about->what_we_do_heading }}
                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        <a href="{{ route('admin.about.second_form') }}" class="btn btn-sm btn-outline-info"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                {{ $about->feature_heading }}
                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        @can('content-edit')
                            <a href="{{ route('admin.about.third_form') }}" class="btn btn-sm btn-outline-info"
                                title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </li>
        </ol>

    </div>
</div>
@push('script')
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script>
@endpush
