<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeService extends Service
{
    /**
     * производит процесс валидации данных о сотруднике и сохранения 
     *
     * @param Request $request
     * @return JsonResponse
     */
    public static function saveEmployee(Request $request) : JsonResponse 
    {
        $validator = Validator::make($request->all(), [
            'password' => 
                'required|string|min:5'
            ,
            'email' => 'required|email|unique:employees'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => self::$errors['validation_err']], 400);
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


    /**
     * производит сохранения данных о зарплатной транзакции
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public static function saveSalaryTransaction(Request $request) : JsonResponse|Response
    {
        $employee = Employee::find($request->employee_id);
        if (! $employee) {
            return response()
                ->json(['error' => self::$errors['id_err']], 400);
        }

        if ($request->hours) {
            $employee->salaries()->create([
                'work_hours' => $request->hours 
            ]);
            return response('', 201);
        } else {
            return response()
                ->json(['error' => self::$errors['params_count_err']], 400);
        }
    }
}