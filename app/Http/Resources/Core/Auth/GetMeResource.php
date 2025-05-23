<?php

namespace App\Http\Resources\Core\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'country' => $this->country?->name,
            'email_verified_at' => $this->email_verified_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'roles' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()?->map(fn ($permission) => $permission->name),
        ];
    }
}