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
            'first_name' => ['required', 'string', 'min:2', 'max:60'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:60', Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['string', 'max:60', 'nullable'],
            'profile_description' => ['string', 'max:255', 'nullable'],
            'phone_number' => ['string', 'min:13', 'max:13', 'nullable'],
            'avatar' => 'nullable|image',
            'birthdate' => ['date', 'nullable'],
            'gender_id' => [Rule::in([1, 2]), 'nullable'],
        ];
    }

    protected function prepareForValidation(){
        if($this->avatar == null) {
            $this->request->remove('avatar');
        }
    }
}
