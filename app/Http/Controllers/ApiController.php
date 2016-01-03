<?php

namespace App\Http\Controllers;

use App\Models\Girl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    /**
     * @var Girl
     */
    protected $girl;

    /**
     * ApiController constructor.
     * @param Girl $girl
     */
    public function __construct(Girl $girl)
    {
        $this->girl = $girl;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allGirls()
    {
        return $this->girl->all();
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