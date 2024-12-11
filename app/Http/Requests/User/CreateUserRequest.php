<?php

namespace App\Http\Requests\User;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|min:8|unique:users,email',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'email.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'password' => DefaultErrorMessages::INVALID_PASSWORD,

            'name.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'password.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'password.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
