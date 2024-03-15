<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'title' => 'required|string|max:255|min:2',
            'description' => 'required|string',
            'max_guests' => 'required|integer|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'main_img' => 'required|string',
            'address' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        
        ];
    }


    // Messaggi di errore 

public function messages()
{
    return [
        'title.required' => 'Il campo titolo è obbligatorio.',
        'title.string' => 'Il campo titolo deve essere una stringa.',
        'title.max' => 'Il campo titolo non può essere più lungo di 255 caratteri.',
        'title.min' => 'Il campo titolo deve contenere almeno 2 caratteri.',
        'description.required' => 'Il campo descrizione è obbligatorio.',
        'description.string' => 'Il campo descrizione deve essere una stringa.',
        'max_guests.required' => 'Il campo ospiti massimi è obbligatorio.',
        'max_guests.integer' => 'Il campo ospiti massimi deve essere un numero intero.',
        'max_guests.min' => 'Il campo ospiti massimi deve essere almeno 1.',
        'rooms.required' => 'Il campo camere è obbligatorio.',
        'rooms.integer' => 'Il campo camere deve essere un numero intero.',
        'rooms.min' => 'Il campo camere deve essere almeno 1.',
        'beds.required' => 'Il campo letti è obbligatorio.',
        'beds.integer' => 'Il campo letti deve essere un numero intero.',
        'beds.min' => 'Il campo letti deve essere almeno 1.',
        'baths.required' => 'Il campo bagni è obbligatorio.',
        'baths.integer' => 'Il campo bagni deve essere un numero intero.',
        'baths.min' => 'Il campo bagni deve essere almeno 1.',
        'main_img.required' => 'Il campo immagine principale è obbligatorio.',
        'main_img.string' => 'Il campo immagine principale deve essere una stringa.',
        'address.required' => 'Il campo indirizzo è obbligatorio.',
        'address.string' => 'Il campo indirizzo deve essere una stringa.',
        'longitude.required' => 'Il campo longitudine è obbligatorio.',
        'longitude.numeric' => 'Il campo longitudine deve essere un numero.',
        'latitude.required' => 'Il campo latitudine è obbligatorio.',
        'latitude.numeric' => 'Il campo latitudine deve essere un numero.',
    ];
}

}


