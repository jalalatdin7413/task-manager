<?php

namespace App\Dto\Core;

use App\Http\Requests\Core\TaskStoreRequest;

readonly class TaskStoreDto
{
    public function __construct(
        public string $title,
        public ?string $description,
        public string $status,
        public ?string $deadline,
        public int $userId
    ) {}

    public static function from(TaskStoreRequest $request): self
    {
        return new self(
            title: $request->title,
            description: $request->description,
            status: $request->status,
            deadline: $request->deadline,
            userId: auth()->id()
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}