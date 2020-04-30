<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class TaskTest extends TestCase
{
    
    public function testList()
    {
        $response = $this->getJson('api/task');
        $response->assertStatus(200);
    }
    
    public function testPost()
    {
        $response = $this->postJson('api/task', [
            'title' => 'A',
            'description' => 'B',
            'assigned_to' => 'C',
            'assigned_by' => 'D',
            'when' => Carbon::now()->format('m/d/Y H:i'),
            'duration' => 1
        ]);
        $response->assertStatus(201);
    }
    
    public function testPut()
    {
        $response = $this->putJson('api/task/1', [
            'done' => 1
        ]);
        $response->assertStatus(200);
    }
    
    public function testPutNotModified()
    {
        $response = $this->putJson('api/task/1');
        $response->assertStatus(304);
    }
    
    public function testGet()
    {
        $response = $this->getJson('api/task/1');
        $response->assertStatus(200);
    }
    
    public function testDelete()
    {
        $response = $this->deleteJson('api/task/1', [
            'done' => 1
        ]);
        $response->assertStatus(200);
    }
    
    
}
