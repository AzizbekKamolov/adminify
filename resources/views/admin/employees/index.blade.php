@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.employees.employees') }}
                </h4>
                @include('admin.employees.importModal')
                @can('view_employee')
                    <span data-toggle="modal" data-target="#m_employee_import"> <i
                            class="btn fa fa-user-plus ml-3">{{ __('form.upload') }} </i> </span>
                @endcan
                @include('admin.employees.exportModal')
                @can('view_employee')
                    <span data-toggle="modal" data-target="#m_employee_export"> <i
                            class="btn fa fa-file-excel-o ml-3">{{ __('form.download') }} </i> </span>
                @endcan
                @can('create_employee')
                    <a href="{{ route("employees.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table  table-responsive-sm">
                    <thead>
                    <tr>
                        <form action="{{ route("employees.index") }}">
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" name="limit"
                                        style="width: 65px">
                                    <option value="5" @selected(request('limit') == 5)>5</option>
                                    <option value="10" @selected(request('limit') == 10 || is_null(request('limit')))>
                                        10
                                    </option>
                                    <option value="20" @selected(request('limit') == 20)>20</option>
                                    <option value="30" @selected(request('limit') == 30)>30</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="fullname"
                                       placeholder="{{ __('validation.attributes.fullname') }}"
                                       value="{{ request('fullname') }}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="passport"
                                       placeholder="{{ __('validation.attributes.passport') }}"
                                       value="{{ request('passport') }}">
                            </td>

                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="department_id" name="department_id">
                                    <option value="" selected
                                            disabled>{{ __('form.departments.departments') }} {{ __('form.choose') }}</option>
                                    @foreach($departments as $department)
                                        <option
                                            value="{{ $department->id }}"
                                            @selected(request('department_id') == $department->id)
                                        >{{ $department->hname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="position_id" name="position_id">
                                    <option value="" selected
                                            disabled>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>
                                    @foreach($positions as $position)
                                        <option
                                            value="{{ $position->id }}"
                                            @selected(request('position_id') == $position->id)
                                        >{{ $position->hname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="branch_id" name="branch_id">
                                    <option value="" selected
                                            disabled>{{ __('form.branches.branches') }} {{ __('form.choose') }}</option>
                                    @foreach($branches as $branch)
                                        <option
                                            value="{{ $branch->id }}"
                                            @selected(request('branch_id') == $branch->id)
                                        >{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="row">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('employees.index') }}" class="btn btn-outline-info"><i
                                            class="fa fa-refresh"></i></a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>{{ __('form.employees.employee') }}</th>
                        <th>{{ __('validation.attributes.birthdate') }}</th>
                        <th>{{ __('validation.attributes.passport') }}</th>
                        <th>{{ __('form.departments.department') }}</th>
                        <th>{{ __('form.branches.branch') }}</th>
                        @canany(['update_employee','delete_employee'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $employee)
                        <tr>

                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td>
                                <div class="media">
                                    @if($employee->file != null)
                                        <img class="wd-30 img-fluid"  src="{{ asset('profile/'.$employee->file['path'])}}" alt="">
                                    @else
                                        <img class="wd-30 img-fluid" src="{{ asset('assets/images/user/user2.png')}}"
                                             alt="">
                                    @endif
                                    <div class="media-body mg-l-10">
                                        <p class="lh-1 mg-0">{{ $employee->fullname }}</p>
                                        <small> {{ $employee->position->hname }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $employee->birthdate }}</td>
                            <td>{{ $employee->passport }}</td>
                            <td>{{ $employee->department->hname}}</td>
                            <td>{{ $employee->branch->name}}</td>
                            <td>
                                @can('update_employee')
                                    <a href="{{ route("employees.edit", [$employee->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_employee')
                                    <a href="{{ route("employees.delete", [$employee->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <nav class="d-flex justify-content-between">
                    <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                    {{ $pagination->links('pagination::bootstrap-4') }}
                    <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
                </nav>
            </div>
        </div>
    </div>

@endsection
