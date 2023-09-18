<?php

namespace App\Services\Helpers;

trait ErrorMessage 
{
    protected static $errors = [
        'validation_err' => 'Валидация переданных данных не пройдена',
        'id_err' => 'Не существует сотрудника с переданным ID',
        'params_count_err' => 'Передано недостаточное количество параметров'
    ];
}