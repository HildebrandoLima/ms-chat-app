<?php

namespace App\Http\Requests\Message;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class UpdateMessageRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:messages,id',
            'text' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'text.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.integer' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'text.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
