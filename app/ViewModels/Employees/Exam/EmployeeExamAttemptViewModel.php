<?php

namespace App\ViewModels\Employees\Exam;

use Akbarali\ViewModel\BaseViewModel;
use Illuminate\Support\Carbon;

class EmployeeExamAttemptViewModel extends BaseViewModel
{
    public int $id;
    public int $employee_id;
    public string $start_time;
    public string $end_time;
    public int $exam_id;
    public int $question_count;
    public int $correct_answers_count = 0;
    public array $questions;
    public ?array $employee_answers;
    public ?string $body = '';
    public ?array $practical_answers = [];
    public bool $attempt_completed;
    public ?string $remaining_time;
    public int $organization_id = 1;
    public bool $status = true;
    public bool $exists_practical = false;
    public ?int $checked_by;
    public ?array $checked_answers = [];
    protected function populate(): void
    {
        $this->practical_answers = json_decode($this->body, true);
        $this->remaining_time = Carbon::parse(Carbon::now()->diffInSeconds($this->end_time))->format("H:i:s");
        $this->status = date("Y-m-d H:i:s") <= $this->end_time;
    }
}
