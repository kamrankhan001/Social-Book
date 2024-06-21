<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'max:255', Rule::unique('users', 'username')->ignore($this->user()->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'username.required' => 'Please choose a username.',
            'username.regex' => 'Your username can only contain lowercase letters, numbers, and dashes. No spaces or special characters are allowed.',
            'username.unique' => 'This username is already taken. Please choose another one.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered. Please use a different email address.',
        ];
    }
}
