@extends('admin.layouts.app')
@section('title', 'Advertisement Management')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <h1>Advertisement Management</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advertisement Management</li>
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
                        @if (request()->routeIs('admin.advertisement.edit'))
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#editad">
                                    <i class="fa fa-plus"></i> Edit Advertisement</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <a class="nav-link show active" href="{{route('admin.advertisement.index')}}">
                                    <i class="icon-arrow-left"></i>&nbsp;Go back</a>
                            </li>
                        
                        @else
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#advertisement">
                                    <i class="fa fa-list"></i> All Advertisement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#addad">
                                    <i class="fa fa-plus"></i> Add Advertisement</a>
                            <li>
                            
                        @endif
                    </ul>
                </div>
                <div class="tab-content">
                    @if ($status == 'edit')
                        <div class="tab-pane active show" id="editad">
                            @include('admin.advertisement.components.edit')
                        </div>
                    @else
                        <div class="tab-pane active show" id="advertisement">
                            @include('admin.advertisement.components.list')
                        </div>
                        <div class="tab-pane" id="addad">
                            @include('admin.advertisement.components.add')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
<script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
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
</script>
<script>



$('#type').on('change', function() {
    var selectedValue = $('#type option:selected').val();

    if (selectedValue === '1' || selectedValue === '3') {
        $('.image').show();
        $('.url').hide();
        if(selectedValue === '3'){
        $('.small').show();
        $('.big').hide();
        $('.link').show();
    }else{
        $('.small').hide();
        $('.big').show();
    }
    } else {
        $('.image').hide();
        $('.url').show();
         $('.link').hide();
    }
});

$(document).ready(function() {
    var selectedValue = $('#type option:selected').val();

if (selectedValue === '1' || selectedValue === '3') {
    $('.image').show();
    $('.url').hide();
    if(selectedValue === '3'){
        $('.small').show();
        $('.big').hide();
        $('.link').show();
    }else{
        $('.small').hide();
        $('.big').show();
    }
} else if(selectedValue === '2') {
    $('.image').hide();
    $('.url').show();
}else{
    $('.image').hide();
   $('.url').hide();
   $('.link').hide();
}
});
    </script>
@yield('script')
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    @yield('style')
@endpush

