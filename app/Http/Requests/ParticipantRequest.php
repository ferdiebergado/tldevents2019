<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParticipantRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required|min:2|max:60',
            'first_name' => 'required|min:2|max:60',
            'mi' => 'required|max:3',
            'sex' => [
                'required',
                Rule::in(['M', 'F'])
            ],
            'station' => 'nullable|max:255',
            'mobile.*' => 'required|min:11|regex:/^[0-9]+$/',
            'email.*' => 'nullable|email|max:255',
            'participant_role_id' => [
                Rule::requiredIf(function () {
                    return \Illuminate\Support\Facades\Route::is('participants.add_to_event');
                }),
                'numeric'
            ],
            'learning_area_id' => 'nullable',
            'language_id' => 'nullable'
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();
        $input['email'] = explode(",", $input['email']);
        $input['mobile'] = explode(",", $input['mobile']);
        $this->replace($input);
        return parent::getValidatorInstance();
    }
}
