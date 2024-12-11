<?php

namespace App\Http\Requests\User;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class UpdateUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'email' => DefaultErrorMessages::INVALID_EMAIL,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'name.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.integer' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
