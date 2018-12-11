<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class ClienteRequest extends FormRequest
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
        $user = User::find($this->segment(2));     
        $rules = ['ragione_sociale' => 'required|max:255'];
        switch ($this->method()) {
            case 'POST':
                $rules += [
                    'username' => 'required|string|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed'
                ];
              break;
              case 'PUT':
              case 'PATCH':              
                $rules += [
                    'username' => 'required|string|max:255|unique:users,username,'.$user->id,
                    'password' => 'nullable|string|min:6|confirmed'                   
                ];
              break;
            // default:
            //     $rules += [
            //         'username' => 'required|string|max:255|unique:users',
            //         'password' => 'required|string|min:6|confirmed'
            //     ];
            //   break;
          }

          return $rules;

    }
}
