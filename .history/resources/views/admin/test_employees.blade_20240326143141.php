<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the employees page is accessible.
     *
     * @return void
     */
    public function test_employees_page_is_accessible()
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
    }

    /**
     * Test if the add employee modal is displayed.
     *
     * @return void
     */
    public function test_add_employee_modal_is_displayed()
    {
        $response = $this->get('/employees');

        $response->assertSee('Thêm nhân viên mới');
    }

    /**
     * Test if pagination functionality works.
     *
     * @return void
     */
    public function test_pagination_functionality()
    {
        // Perform an AJAX request to load page 1
        $response = $this->get('/ajax-paginate?page=1');

        $response->assertStatus(200);
        // Assert that the response contains the expected HTML content
        $response->assertSee('table-data');
    }
}