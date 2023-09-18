<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class EmployeeController extends Controller
{
    public function createEmployee(Request $request) : JsonResponse
    {
        return EmployeeService::saveEmployee($request);
    }


    public function createTransaction(Request $request) : JsonResponse|Response
    {
        return EmployeeService::saveSalaryTransaction($request);
    }
}
