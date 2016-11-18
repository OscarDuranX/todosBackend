<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use Response;

/**
 * Class TasksController
 *
 * lorem  docuemtnacio *opcional
 *
 * @package App\Http\Controllers
 */
class TasksController extends Controller
{

    /**
     * Repository object
     *
     * @var TaskRepository
     */
    protected $repository;


    /**
     * TasksController constructor.
     *
     * @param TaskTransformer $transformer
     * @param TaskRepository $repository
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository)
    {

        $this->repository = $repository;


        parent::__construct($transformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // No metadata
        // Pagination
        // No error messages
        // Transformations: hem de transformar el que ensenyem
        $tasks = Task::paginate(15);

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Sergi Tur']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        $request->input('name');
//        dd($request->all());

        Task::create($request->all());
//        Task::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        try {
//            return Task::findOrFail($id);
//        } catch (\Exception $e) {
//            return Response::json([
//                "error" => "Hi ha hagut una excepció",
//                "code" => 10
//            ],404);
//        }

//        $task = Task::find($id);
//
//        if ( $task != null) {
//            return $task;
//        }
//
//        return Response::json([
//            "error" => "Hi ha hagut una excepció",
//            "code" => 10
//        ],404);

//        $task = Task::findOrFail($id);

        $task = $this->repository->find($id);
        return $this->transformer->transform($task);

//        return $this->transformer->transform($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
