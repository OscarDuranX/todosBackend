<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksApiTest extends TestCase
{

    protected $URI = '/api/task';
    use DatabaseMigrations;
    public function testShowAllTasks()
    {
        $this->json('GET',$this->URI)
//            ->dump()
              ->seeJson();
    }

    public function testShowOneTask()
    {
        $task = factory(App\Task::class) ->create();
        $this->json('GET', $this->URI .'/'. $task->id)
//            ->dump();
//            ->seeJson();
              ->seeJsonStructure(
                  ["id", "name", "done", "priority"]
              )
              ->seeJsonContains([
                "name" => $task->name,
                "done" => $task->done,
                "priority" => $task->priority
              ]);
    }
}
