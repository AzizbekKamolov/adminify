<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('validation.attributes.fullname') }}</th>
        <th>{{ __('validation.attributes.passport') }}</th>
        {{--        <th>{{ __('form.departments.department') }}</th>--}}
        <th>{{ __('form.positions.position') }}</th>
        {{--        <th>{{ __('form.branches.branch') }}</th>--}}
        <th>{{ __('quiz.employee.correct_answers_count') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pagination->items() as $employee)
        @php $correctAnswersCount = null; $checkedBy = null; @endphp
        @foreach($employee->employeeExamAttempts as $attempt)
            @php $correctAnswersCount = $attempt->correct_answers_count; $checkedBy = $attempt->checked_by; @endphp
            @break
        @endforeach

        <tr @if(is_null($checkedBy)) class="bg-light" @endif>
            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
            <td>
                <a href="" data-toggle="modal"
                   data-target="#m_modal_attempt_{{ $employee->id }}">{{ $employee->fullname }}</a>
                @include('admin.quiz.exams.attempt_show')
            </td>
            <td>{{ $employee->passport }}</td>
            {{--            <td>{{ $employee->department->hname}}</td>--}}
            <td>{{ $employee->position->hname}}</td>
            <td>
                {{ $correctAnswersCount }}
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

