<?php

namespace App\Http\Requests\User;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class UserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|exists:users,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.exists' => DefaultErrorMessages::NOT_FOUND,
            'name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
