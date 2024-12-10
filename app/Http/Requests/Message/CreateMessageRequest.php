<?php

namespace App\Http\Requests\Message;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateMessageRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from' => 'required|integer|exists:users,id',
            'text' => 'required|string',
            'to' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'from.exists' => DefaultErrorMessages::NOT_FOUND,
            'to.exists' => DefaultErrorMessages::NOT_FOUND,

            'from.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'text.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'to.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'from.integer' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'text.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'to.integer' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
