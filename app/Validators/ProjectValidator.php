<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required|integer|exists:users,id',
        'client_id' => 'required|integer|exists:clients,id',
        'name' => 'required',
        'description' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];
} 