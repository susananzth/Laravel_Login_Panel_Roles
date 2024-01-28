<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Asignar el rol de cliente si no tiene ningún rol asignado
        if (!$user->roles()->get()->contains(3)) {
            $user->roles()->attach(3);
        }

        // Asignar imagen predeterminada si el usuario no tiene una imagen
        if (!$user->image) {
            $defaultImagePath = public_path('img/profile.png'); // Ruta de la imagen predeterminada
            $randomFileName = hash('sha256', time() . Str::random(10)) . '.png'; // Nombre de archivo aleatorio

            // Copiar la imagen predeterminada al almacenamiento
            $storagePath = 'app/public/images/' . $randomFileName;
            File::copy($defaultImagePath, storage_path($storagePath));

            // Asociar la imagen predeterminada al usuario mediante la relación polimórfica
            $user->image()->create([
                'url' => $randomFileName,
            ]);
        }
    }
}
