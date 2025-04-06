<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'vehicle_type',
        'entry_time',
        'exit_time',
        'amount',
    ];

    public static function rules()
    {
        return [
            'plate' => [
                'required',
                'regex:/^[A-Za-z0-9]+$/', // Sin caracteres especiales
                function ($attribute, $value, $fail) {
                    $existingParking = self::where('plate', strtoupper($value))
                        ->whereNull('exit_time') // Solo si no ha salido
                        ->first();

                    if ($existingParking) {
                        $fail("El vehículo con placa {$value} ya está en el parqueadero.");
                    }
                },
            ],
            'vehicle_type' => ['required', 'in:car,motorcycle'], // Solo 'car' o 'motorcycle'
        ];
    }
}