<?php

namespace App\Http\Controllers;

use App\Models\Girl;
use App\Services\GirlServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    /**
     * @var GirlServiceInterface
     */
    private $girl;

    /**
     * @param GirlServiceInterface $girl
     */
    public function __construct(GirlServiceInterface $service)
    {
        $this->girl = $service;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allGirls()
    {
        $allGirls = $this->girl->getAll();

        return new JsonResponse($allGirls, 200);
    }

    /**
     * @param Request $request
     */
    public function newGirl(Request $request)
    {
        $id = $this->girl->create($request->all());
        return DB::getPdo()->lastInsertId();
    }

    public function deleteGirl(Request $request, $id)
    {
        if($this->girl->destroy($id)) {
            return new JsonResponse(['deleted' => true], 200);
        }

        return new JsonResponse(['deleted' => false], 500);
    }
}
