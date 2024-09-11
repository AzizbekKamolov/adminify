@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        {{--        <div class="row mb-3">--}}
        {{--            <div class="col-md-13 text-right">--}}
        {{--                <a href="{{ route('departments.create') }}" class="btn btn-primary">{{ __('form.add') }}</a>--}}

        {{--            </div>--}}
        {{--        </div>--}}
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.medical.medical_status') }}
                </h4>
                @can('view_medicalstatus')
                    <a href="{{ route("medical.statuses.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('form.medical.medical_results') }}</th>
                        @canany(['delete_medicalstatus','update_medicalstatus'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $medicalstatus)
                        <tr>
                            <td>{{ $medicalstatus->hname }}</td>
                            <td>{{ $medicalstatus->medical_results}}</td>
                            <td>
                                @can('update_medicalstatus')
                                    <a href="{{ route("medical.statuses.edit", [$medicalstatus->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_medicalstatus')
                                    <a href="{{ route("medical.statuses.delete", [$medicalstatus->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
