<?php

namespace Tests\Repositories;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Carbon\Carbon;

class BaseServiceTest extends TestCase
{   
    
    protected $baseService;
    protected $record;

    public function setUp() : void
    {   
        parent::setUp();
        $model = new User();        
        $userRepository = new UserRepository($model);
        $this->baseService = $this->getMockForAbstractClass(BaseService::class, [$userRepository], 'BaseService');
    }

    public function test_find_all()
    {   
        $this->assertCount(10, $this->baseService->findAll(10, 'id'));
    }   

    public function test_find_by_id()
    {   
        $register =  $this->baseService->findById(1);
        $this->assertArrayHasKey('id', $register);
        $this->assertEquals(1, $register['id']);
    }  

    public function test_create_register(){
        
        $data = [
            'name' => 'test',
            'email' => 'teste@gmail.com',
            'document' => '123456789',	
            'password' => '123456',
            'user_category_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $record = $this->baseService->create($data);       
        $this->assertArrayHasKey('id', $record);
        return $record["id"];	        
    }

    /**
     * @depends test_create_register
     */
    public function test_delete_register($id){            
        $this->assertTrue($this->baseService->delete($id));
    }


}