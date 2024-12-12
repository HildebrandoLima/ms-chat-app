<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Message\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;

class ListAllMessageRepository implements IListAllMessageRepository
{
    use RequestConfigurator;

    private Collection $responseData;
    private Collection $messages;
    private Collection $users;

    public function listAll(MessageRequest $request): Collection
    {
        $this->setRequest($request);
        $this->queryUser();
        $this->queryMessage();
        $this->collectData();
        return $this->responseData;
    }

    private function queryUser(): void
    {
        $this->users = User::whereIn('id', [$this->request->from, $this->request->to])->select(['id', 'name'])->get();
    }

    private function queryMessage(): void
    {
        $this->messages = Message::
            where(function ($query) {
                $query->where('from', $this->request->from)
                    ->where('to', $this->request->to)
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('from', $this->request->to)
                                ->where('to', $this->request->from);
                    });
            })
        ->orderBy('created_at', 'asc')
        ->get();
    }

    private function collectData(): void
    {
        $this->responseData = collect(['users' => $this->users, 'messages' => $this->messages]);
    }
}
