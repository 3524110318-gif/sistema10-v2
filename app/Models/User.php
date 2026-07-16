<?php

namespace App\Models;

// IMPORTA LA FACTORY PARA CREAR USUARIOS DE PRUEBA
use Database\Factories\UserFactory;

// IMPORTA EL ATRIBUTO FILLABLE
use Illuminate\Database\Eloquent\Attributes\Fillable;

// IMPORTA EL ATRIBUTO HIDDEN
use Illuminate\Database\Eloquent\Attributes\Hidden;

// PERMITE USAR FACTORIES
use Illuminate\Database\Eloquent\Factories\HasFactory;

// CLASE PRINCIPAL DE AUTENTICACIÓN DE LARAVEL
use Illuminate\Foundation\Auth\User as Authenticatable;

// SISTEMA DE NOTIFICACIONES
use Illuminate\Notifications\Notifiable;

// CAMPOS QUE SE PUEDEN GUARDAR MASIVAMENTE
// AQUÍ AGREGAMOS EL CAMPO 'rol'
#[Fillable([
    'name',
    'email',
    'password',
    'rol'
])]

// CAMPOS OCULTOS
// NO SE MOSTRARÁN EN RESPUESTAS JSON
#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    // ACTIVA FACTORIES Y NOTIFICACIONES
    use HasFactory, Notifiable;

    /**
     * CONVIERTE TIPOS DE DATOS AUTOMÁTICAMENTE
     */
    protected function casts(): array
    {
        return [

            // CONVIERTE LA FECHA A FORMATO DATETIME
            'email_verified_at' => 'datetime',

            // ENCRIPTA AUTOMÁTICAMENTE EL PASSWORD
            'password' => 'hashed',
        ];
    }
}