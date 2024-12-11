<?php

namespace App\Http\Requests\Message;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class MessageRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'to' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'to.exists' => DefaultErrorMessages::NOT_FOUND,
            'to.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'to.integer' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
