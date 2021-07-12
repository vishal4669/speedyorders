<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AdminRbac\Models\AdminUserGroup;
use Tests\TestCase;
use App\Models\User;
class AdminCategoryTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();
    }

    /** @test */
    public function only_authenticated_user_sees_admin_categories_list(){

        $response = $this->get('/admin/categories')->assertRedirect('/admin/login');

    }

    /** @test */
    public function authenticated_user_sees_admin_categories_list(){
        $user = factory(User::class,1)->create(['email'=>'thapa.binay111@gmail.com']);
        $this->actingAs($user);
///        factory(AdminUserGroup::class)->create(['user_id'=>1,'group_id'=>1]);
        $response = $this->get('/admin/categories')->assertOk();

    }
}
