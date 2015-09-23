<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\User;

/**
 * Class MemberTransformer
 * @package namespace CodeProject\Transformers;
 */
class MemberTransformer extends TransformerAbstract
{

    /**
     * Transform the \Member entity
     * @param \Member $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'     => (int) $model->id,
            'name' => $model->name,
        ];
    }
}
