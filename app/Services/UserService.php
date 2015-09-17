<?php

namespace CodeUser\Services;

use CodeUser\Repositories\UserRepository;
use CodeUser\Validators\UserValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService {

    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var UserValidator
     */
    private $validator;

    /**
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
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



} 