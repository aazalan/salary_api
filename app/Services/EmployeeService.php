<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeService 
{
    public static function saveEmployee(Request $request) : JsonResponse 
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required', 
                'string'
            ],
            'email' => 'required|email|unique:employees'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => 'Валидация переданных данных не пройдена'], 400);
        }
        elseif ($validator->validated()) {
            $employee = Employee::create([
                'password' => Hash::make($validator->validated()['password']),
                'email' => $validator->validated()['email']
            ]);
            
            return response()
                ->json(['employee_id' => $employee->id], 201);
        }
    }

    public static function saveSalaryTransaction(Request $request) : JsonResponse|Response
    {
        $employee = Employee::find($request->employee_id);
        if (! $employee) {
            return response()
                ->json(['error' => 'Не существует сотрудника с переданным ID'], 400);
        }

        if ($request->hours) {
            $employee->salaries()->create([
                'work_hours' => $request->hours 
            ]);
            return response('', 201);
        } else {
            return response()
                ->json(['error' => 'Передано недостаточное количество параметров'], 400);
        }
    }
}