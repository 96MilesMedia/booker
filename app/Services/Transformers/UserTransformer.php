<?php

namespace App\Services\Transformers;

use App\Core\Contracts\TransformerInterface;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract implements TransformerInterface
{
    public function transform($user)
    {
        return [
            'email' => $user->email,
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'permissions' => $user->permissions,
            'last_login' => $user->last_login
        ];
    }
}
