<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\MemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class MemberService {

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var MemberValidator
     */
    private $validator;

    /**
     * @param ProjectRepository $repository
     * @param MemberValidator $validator
     */
    public function __construct(ProjectRepository $repository, MemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function addMember(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            $this->repository->find($data['project_id'])->members()->attach($data['user_id']);

            return [
                'error'   => false,
                'message' => "Membro #${data['user_id']} adicionado ao Projeto #${data['project_id']}"
            ];
        } catch(ValidatorException $e) {
            return [
                'error'   =>true,
                'message' =>$e->getMessageBag()
            ];
        }
    }

    public function removeMember(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            $this->repository->find($data['project_id'])->members()->detach($data['user_id']);

            return [
                'error'   => false,
                'message' => "Membro #${data['user_id']} removido do Projeto #${data['project_id']}"
            ];
        } catch(ValidatorException $e) {
            return [
                'error'   =>true,
                'message' =>$e->getMessageBag()
            ];
        }
    }

    public function isMember($id, $memberId)
    {
        try {
            $result = [];

            $member = $this->repository->find($id)->members()->find($memberId);

            if (is_null($member)) {
                $result = [
                    'error'   => true,
                    'message' => "O Membro #$memberId não encontrado no Projeto #$id"
                ];
            } else {
                $result = [
                    'error'   => false,
                    'message' => "O Membro #$memberId pertence ao Projeto #$id"
                ];
            }

            return $result;
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'error'   => true,
                'message' => 'Projeto não encontrado!'
            ];
        }

    }
} 