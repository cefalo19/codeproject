<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService {

    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteValidator
     */
    private $validator;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

    public function delete($id, $taskId)
    {
        try {
            $this->repository->delete($taskId);

            return [
                'message' => "Tarefa #$taskId deletada!"
            ];
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'error'   => true,
                'message' => 'Tarefa não encontrada!'
            ];
        }
    }

} 