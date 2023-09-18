<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class EmployeeController extends Controller
{
    /**
     * создает нового сотрудника
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createEmployee(Request $request) : JsonResponse
    {
        return EmployeeService::saveEmployee($request);
    }


    /**
     * создает транзакцию отработанных часов
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function createTransaction(Request $request) : JsonResponse|Response
    {
        return EmployeeService::saveSalaryTransaction($request);
    }
}
