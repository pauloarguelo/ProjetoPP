<?php

namespace Tests\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class BaseRepositoryTest extends TestCase
{   
    
    protected $baseRepository;
    protected $record;

    public function setUp() : void
    {   
        parent::setUp();
        $model = new User();        
        $this->baseRepository = $this->getMockForAbstractClass(BaseRepository::class, [$model], 'BaseRepository');
    }

    public function test_find_all()
    {   
        $this->assertCount(10, $this->baseRepository->findAll(10, 'id'));
    }   

    public function test_find_by_id()
    {   
        $register =  $this->baseRepository->findById(1);
        $this->assertArrayHasKey('id', $register);
        $this->assertEquals(1, $register['id']);
    }  

    public function test_create_register(){
        
        $data = [
            'name' => 'Repository Test User',
            'email' => 'repository-teste-user@gmail.com',
            'document' => '831.023.470-88',	
            'password' => Hash::make('123456'),
            'user_category_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $record = $this->baseRepository->create($data);       
        $this->assertArrayHasKey('id', $record);
        return $record["id"];	        
    }

    /**
     * @depends test_create_register
     */
    public function test_delete_register($id){            
        $this->assertTrue($this->baseRepository->delete($id));
    }


}