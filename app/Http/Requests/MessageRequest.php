<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'post_id' => ['required'],
            'message' => ['required'],
            'attachments' => 'file|mimes:jpg,png,gif,mp3,wav',
        ];
    }

    public function messages()
    {
        return [
            'sender_id.required' => 'El usuario es requerido.',
            'receiver_id.required' => 'El usuario es requerido.',
            'post_id.required' => 'El post es requerido.',
            'message.required' => 'El mensaje es obligatorio.',
            'attachments.mimes' => 'Está ingresando un archivo no permitido.',
        ];
    }
}
