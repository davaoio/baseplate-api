<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the user into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'email_verified' => $this->isEmailVerified(),
            'verified' => $this->isVerified(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'avatar_url' => route('user.avatar.show', ['id' => $this->id]),
            'avatar_thumb_url' => route('user.avatar.showThumb', ['id' => $this->id]),
            'mine' => $this->id == optional(auth()->user())->id,
            'avatar' => $this->whenLoaded('avatar', new MediaResource($this->avatar))
        ];
    }
}
