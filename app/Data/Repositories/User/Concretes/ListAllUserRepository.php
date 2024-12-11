<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllUserRepository implements IListAllUserRepository
{
    private Builder $query;

    public function listAll(UserRequest $request): Collection
    {
        $this->query = User::with(['friends'])->where('id', 1);

        if (!empty($this->request->name)) {
            $this->query->where('users.name', 'like', '%' . $request->name . '%');
        }

        return $this->query->get();
    }
}
