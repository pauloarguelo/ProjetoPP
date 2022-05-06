<?php

namespace Tests\Repositories;

use App\Models\User;
use phpDocumentor\Reflection\Types\Void_;
use Tests\TestCase;
use App\Repositories\BaseRepository;

class BaseRepositoryTest extends TestCase
{   
    
    protected $baseRepository;

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
}