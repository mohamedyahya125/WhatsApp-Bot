<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    public function createEmployee($data)
    {
        $employee = Employee::create($data);
        return $employee;
    }
    public function getAllEmployees()
    {
        return Employee::paginate(10);
    }
    public function getEmployeeById($id)
    {
        $show = Employee::find($id);
        return $show;
    }
    public function updateEmployee($id, $data)
    {
        $update = Employee::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteEmployee($id)
    {
        $delete = Employee::find($id);
        $delete->delete();
        return true;
    }
}
