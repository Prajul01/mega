@extends('admin.layouts.app')
@section('title', 'Step Procedure Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Pricing Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pricing Management</li>
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
                                <a class="nav-link show active" href="{{ route('admin.pricing.mainIndex') }}">
                                    <i class="fa fa-angle-double-left"></i>
                                    Go back</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#">
                                    <i class="fa fa-list"></i>
                                    {{ ucwords(str_replace('-', ' ', $step->posting_type)) }}</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('admin.pricing.create', base64_encode($step->id)) }}">
                                    <i class="fa fa-plus"></i>&nbsp;Add Pricing</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (count($daysCount) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="bg-secondary text-white text-center">No. of Jobs</th>
                                            @foreach ($days as $day)
                                                <th class="bg-secondary text-white text-center">{{ $day->days }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $dayId = $days->pluck('id')->toArray(); ?>
                                        @foreach ($pricing as $key => $price)
                                            <tr>
                                                <td class="text-center">{{ $key }}</td>
                                                @foreach ($days as $key => $day)
                                                    @foreach ($price as $data)
                                                        <?php $flag = false; ?>
                                                        @if ($day->id == $data->day_package_id)
                                                            <form
                                                                action="{{ route('admin.pricing.destroy', ['ad_type' => base64_encode($step->id),'id'=>base64_encode($data->id)]) }}"
                                                                method="POST" id="form-{{ $data->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <td class="text-center"><strong>{{ $data->price }}</strong>
                                                                <a href="#" class="btn btn-danger mx-2"
                                                                    onclick="deletePrice('{{ $data->id }}')" style="float:right"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a href="{{ route('admin.pricing.edit', [
                                                                    'ad_type' => base64_encode($step->id),
                                                                    'no_of_days' => $key,
                                                                    'package' => base64_encode($day->id),
                                                                    'price' => $data->price,
                                                                ]) }}"
                                                                    class="btn btn-warning" style="float:right"><i
                                                                        class="fa fa-edit"></i></a>
                                                            </td>
                                                        @break

                                                    @else
                                                        <?php $flag = true; ?>
                                                    @endif
                                                @endforeach
                                                @if (@$flag)
                                                    <td class="text-center"><strong>-</strong><a
                                                            href="{{ route('admin.pricing.create', [
                                                                'ad_type' => base64_encode($step->id),
                                                                'no_of_days' => $key,
                                                                'package' => base64_encode($day->id),
                                                            ]) }}"
                                                            class="btn btn-success" style="float: right;"><i
                                                                class="fa fa-plus"></i></a></td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-12 text-center">
                                <h4>The pricing has not been set</h4>
                                <a href="{{ route('admin.pricing.create', base64_encode($step->id)) }}"
                                    class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add Pricing</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function deletePrice(key) {
        confirm = confirm('Are you sure?');
        if(confirm){
            $('#form-' + key ).submit();
        }
    }
</script>
@endpush
