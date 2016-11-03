<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $tasks
     * @return \Illuminate\Http\JsonResponse
     */
    public function generatePaginatedResponse($resources, array $metadata = [])
    {
        $pagination = $this->generatePaginatedDate($resources);

        $data = [
            'data' => $this->transformCollecton($resources->items())
        ];

        return Response::json(array_merge($metadata, $pagination, $data), 200);
    }

    /**
     * @param $tasks
     * @return array
     */
    public function generatePaginatedDate($resources)
    {
        $paginationData = [
            'propietari' => 'Oscar Duran',
            'total' => $resources->total(),
            'per_page' => $resources->perPage(),
            'current_page' => $resources->currentPage(),
            'last_page' => $resources->lastPage(),
            'next_page' => $resources->nextPageurl(),
            'prev_page_Url' => $resources->previousPageUrl(),

        ];
        return $paginationData;
    }

    protected function transform($resources)
    {
        return [
            'name' => $resources['name'],
            'done' => (boolean)$resources['done'],
            'priority' => (integer)$resources['priority']
        ];
    }

    protected function transformCollecton($resources)
    {

        return array_map(function ($resources) {
            return $this->transform($resources);
        }, $resources);

    }
}
