<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalaryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * правильный вывод суммы зарплат 
     *
     * @return void
     */
    public function test_show_all_salaries_1(): void
    {
        $response_1 = $this->post('/api/employee', [
            'email' => 'test_mail_1@gmail.com',
            'password' => 'password'
        ]);

        $response_2 = $this->post('/api/employee', [
            'email' => 'test_mail_2@gmail.com',
            'password' => 'password'
        ]);

        $response_3 = $this->post('/api/employee/hours', [
            'employee_id' => $response_1['employee_id'],
            'hours' => 5
        ]);

        $response_4 = $this->post('/api/employee/hours', [
            'employee_id' => $response_1['employee_id'],
            'hours' => 4
        ]);

        $response_4 = $this->post('/api/employee/hours', [
            'employee_id' => $response_2['employee_id'],
            'hours' => 12
        ]);

        $response_5 = $this->get('/api/salaries');

        $response_5->assertStatus(200)
        ->assertJson([
            $response_1['employee_id'] => 900,
            $response_2['employee_id'] => 1200
        ]);
    }


    /**
     * вывод суммы зарплат при отсутсвии зарплатных транзакций в базе данных
     *
     * @return void
     */
    public function test_show_all_salaries_2() : void
    {
        $response_5 = $this->get('/api/salaries');

        $response_5->assertStatus(200)
        ->assertJson([]);
    }


    /**
     * погашение всех транзакций
     *
     * @return void
     */
    public function test_cancel_all_salaries_transactions_2() : void
    {
        $response_5 = $this->delete('/api/salaries');

        $response_5->assertStatus(200);
    }
}
