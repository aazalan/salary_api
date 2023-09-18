<?php

namespace App\Services\Helpers;

/**
 * класс для расчета зарплат
 * создан для предполагаемого расширения по функционалу расчета зарплат
 */
class SalaryCounter 
{
    private static int $ratePerHour = 100;

    /**
     * высчитывает зарплату по количеству переданных часов
     *
     * @param integer $hours
     * @return void
     */
    public static function countSalary(int $hours) {
        return $hours * self::$ratePerHour;
    }
}