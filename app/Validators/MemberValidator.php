<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class MemberValidator extends LaravelValidator {

    protected $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'project_id' => 'required|integer|exists:projects,id',
    ];
} 