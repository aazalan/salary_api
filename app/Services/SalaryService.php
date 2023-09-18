<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Salary;
use App\Services\Helpers\SalaryCounter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class SalaryService extends Service
{
    /**
     * производит процесс запроса и подсчета сумм зарплат
     *
     * @return JsonResponse
     */
    public static function getAllSalaries() : JsonResponse
    {
        $salaries = [];
        foreach(Employee::all() as  $employee) {
            $salariesSum =  SalaryCounter::countSalary($employee->salaries->sum('work_hours')); 
            if ($salariesSum !== 0) {
                $salaries[$employee->id] = $salariesSum;
            }
        }
        return response()->json($salaries);
    }


    /**
     * удаляет все транзакции зарплат из базы данных
     *
     * @return Response
     */
    public static function deleteAllTransactions() : Response
    {
        Salary::truncate();
        return response('', 200);
    }
}