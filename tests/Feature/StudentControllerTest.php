<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\City;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Sukuriame miestus ir grupes
        City::factory()->create(['name' => 'Vilnius']);
        Group::factory()->create(['code'=>'G1','name'=>'Programuotojai']);
    }

    /** @test */
    public function guests_can_see_student_index_but_not_create_or_edit()
    {
        $response = $this->get(route('students.index'));
        $response->assertStatus(200);

        $response = $this->get(route('students.create'));
        $response->assertRedirect('/login'); // Breeze redirectina neprisijungusius
    }

    /** @test */
    public function authenticated_user_can_create_student()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('students.store'), [
            'name' => 'Test',
            'surname' => 'Student',
            'address' => 'Adresas 123',
            'phone' => '123456789',
            'city_id' => 1,
            'grupe_id' => 1,
            'gim_data' => '2000-01-01'
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'name' => 'Test',
            'surname' => 'Student',
            'grupe_id' => 1
        ]);
    }

    /** @test */
    public function guests_cannot_create_or_edit_student()
    {
        $response = $this->post(route('students.store'), [
            'name' => 'Test',
            'surname' => 'Student',
            'address' => 'Adresas 123',
            'phone' => '123456789',
            'city_id' => 1,
            'grupe_id' => 1,
            'gim_data' => '2000-01-01'
        ]);

        $response->assertRedirect('/login'); // redirect neprisijungusiems
    }
}