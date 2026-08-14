<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request, EmployeeService $employee)
    {
        $data = $request->all();
        $create = $employee->createEmployee($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(EmployeeService $employee)
    {
        $show = $employee->getAllEmployees();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, EmployeeService $employee)
    {
        $idshow = $employee->getEmployeeById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, EmployeeService $employee)
    {
        $data = $request->all();
        $update = $employee->updateEmployee($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, EmployeeService $employee)
    {
        $delete = $employee->deleteEmployee($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
