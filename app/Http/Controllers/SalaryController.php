<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SalaryController extends Controller
{
    public function showAll() : JsonResponse
    {
        $salaries = [];
        foreach(Employee::all() as  $employee) {
            $salariesSum =  $employee->salaries->sum('work_hours'); 
            if ($salariesSum !== 0) {
                $salaries[$employee->id] = $salariesSum;
            }
        }
        return response()->json($salaries);
    } 

    public function cancelTransactions() : Response
    {
        Salary::truncate();
        return response('', 200);
    }
}
