<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ];
} 