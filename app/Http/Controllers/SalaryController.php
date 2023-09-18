<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Services\SalaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SalaryController extends Controller
{
    /**
     * выводит суммы зарплат
     *
     * @return JsonResponse
     */
    public function showAll() : JsonResponse
    {
        return SalaryService::getAllSalaries();
    } 

    /**
     * погашает все транзакции
     *
     * @return Response
     */
    public function cancelTransactions() : Response
    {
        return SalaryService::deleteAllTransactions();
    }
}
