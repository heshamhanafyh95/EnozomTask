<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::join('salaries', 'salaries.emp_no', 'employees.emp_no')
            ->select(DB::raw('sum(salaries.salary) as total_salary, count(salaries.salary) as total_count,employees.first_name,employees.last_name'))
            ->groupBy('employees.emp_no')
            ->orderByDesc('total_salary')->first();
        return view('welcome', ['employee' => $employee]);
    }
}
