@extends('admin.layouts.app')
@section('title', 'Terms And Conditions')
@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Terms And Condition Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Terms And Condition Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#projects">
                                        <i class="fa fa-list"></i> Update Terms And Condition
                                    </a>
                                </li>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                      
                    <form method="POST" action="{{ route('admin.terms.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="body">
                            <div class="row">
                               
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Long Content</span>
                                        </div>
                                        <textarea name="description"  class="form-control"  id="ckeditor" rows="5" required>{{ old('description',$term->description) }}</textarea>
                                    </div>
                                    @error('description')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
                            <button style="float: right" type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                    
                    @push('script')
                        <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
                        <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
                        <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
                        <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
                        <script>
                            var editor_config = {
                                toolbar: [{
                                        name: 'document',
                                        groups: ['mode', 'document', 'doctools']
                                       
                                    },
                                    {
                                        name: 'clipboard',
                                        groups: ['clipboard', 'undo'],
                                        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                                    },
                                    {
                                        name: 'editing',
                                        groups: ['find', 'selection', 'spellchecker'],
                                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                                    },
                                    {
                                        name: 'basicstyles',
                                        groups: ['basicstyles', 'cleanup'],
                                        items: ['Bold', 'Italic', 'Underline', '-',
                                            'RemoveFormat'
                                        ]
                                    },
                                    {
                                        name: 'paragraph',
                                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                                            'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                                        ]
                                    },
                                    {
                                        name: 'links',
                                        items: ['Link']
                                    },
                                    '/',
                                    {
                                        name: 'styles',
                                        items: ['Styles', 'Format', 'Font', 'FontSize']
                                    },
                                    {
                                        name: 'colors',
                                        items: ['TextColor']
                                    },
                                ],
                                width: ['100%']
                            };
                            CKEDITOR.replace('ckeditor', editor_config);
                            CKEDITOR.replace('ckeditor1', editor_config);
                            CKEDITOR.replace('ckeditor2', editor_config);
                        </script>
                        <script>
                            $(document).ready(function() {
                                $('.multiple-cat').select2();
                            });
                        </script>
                    @endpush
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
