<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EmployeeTest extends TestCase
{

    use RefreshDatabase;

    /**
     * положительный результат сохранения сотрудника 
     *
     * @return void
     */
    public function test_create_employee_1(): void
    {
        $response = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'password'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('employee_id')
            );
    }

    /**
     * не переданы данные для сохранения сотрудника
     *
     * @return void
     */
    public function test_create_employee_2(): void
    {
        $response = $this->post('/api/employee', []);

        $response
            ->assertStatus(400)
            ->assertJson([
                "error" => "Валидация переданных данных не пройдена"
            ]);
    }


    /**
     * дублирование почты
     *
     * @return void
     */
    public function test_create_employee_3(): void
    {
        $response_1 = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'password'
        ]);

        $response_2 = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'password'
        ]);

        $response_2
            ->assertStatus(400)
            ->assertJson([
                "error" => "Валидация переданных данных не пройдена"
            ]);
    }

    /**
     * слишком короткий пароль
     *
     * @return void
     */
    public function test_create_employee_5(): void
    {
        $response = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'pass'
        ]);
        $response
            ->assertStatus(400)
            ->assertJson([
                "error" => "Валидация переданных данных не пройдена"
            ]);
    }

    
    /**
     * положительный результат сохранения зарплатной транзакции
     *
     * @return void
     */
    public function test_save_transaction_1(): void
    {
        $response_1 = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'password'
        ]);

        $response_2 = $this->post('/api/employee/hours', [
            'employee_id' => $response_1['employee_id'],
            'hours' => 5
        ]);

        $response_2
            ->assertStatus(201);
    }


    /**
     * не существует сотрудника с таким ID
     *
     * @return void
     */
    public function test_save_transaction_2(): void
    {
        $response = $this->post('/api/employee/hours', [
            'employee_id' => '',
            'hours' => 5
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                "error" => "Не существует сотрудника с переданным ID"
            ]);
    }


    /**
     * не передан 2 параметр 'hours' - часы работы
     *
     * @return void
     */
    public function test_save_transaction_3(): void
    {
        $response_1 = $this->post('/api/employee', [
            'email' => 'test_mail@gmail.com',
            'password' => 'password'
        ]);

        $response_2 = $this->post('/api/employee/hours', [
            'employee_id' => $response_1['employee_id']
        ]);

        $response_2
            ->assertStatus(400)
            ->assertJson([
                "error" => "Передано недостаточное количество параметров"
            ]);;
    }
}
