<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService {

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);
        } catch(ValidatorException $e) {
            return [
                'error'   =>true,
                'message' =>$e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);
        }  catch(ValidatorException $e) {
            return [
                'error'   => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);

            return [
                'message' => "Projeto #$id deletado!"
            ];
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'error'   => true,
                'message' => 'Projeto não encontrado!'
            ];
        }
    }
} 