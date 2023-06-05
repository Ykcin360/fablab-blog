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
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['string', 'max:255', 'nullable'],
            'profile_description' => ['string', 'max:255', 'nullable'],
            'phone_number' => ['string','max:13', 'nullable'],
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
