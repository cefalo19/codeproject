<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\MemberService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var MemberService
     */
    private $service;

    public function __construct(ProjectRepository $repository, MemberService $service) {

        $this->repository = $repository;
        $this->service = $service;
    }

    public function all($id)
    {
        try {
            return $this->repository->skipPresenter()->find($id)->members;
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'error'   => true,
                'message' => 'Projeto não encontrado!'
            ];
        }
    }

    public function add(Request $request)
    {
        return $this->service->addMember($request->all());
    }


    public function remove(Request $request)
    {
        return $this->service->removeMember($request->all());
    }

    public function isMember($id, $memberId)
    {
        return $this->service->isMember($id, $memberId);
    }
}
