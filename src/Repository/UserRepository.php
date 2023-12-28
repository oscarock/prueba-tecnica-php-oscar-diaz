<?php

namespace Oscarock\PruebaTecnicaOscarDiazPhp\Repository;
use Oscarock\PruebaTecnicaOscarDiazPhp\Model\User;

class UserRepository
{
    private $users = [];

    public function save(User $user)
    {
        $userId = $user->getId();
        if ($userId !== null && !array_key_exists($userId, $this->users)) {
            $this->users[$userId] = $user;
            echo "Usuario guardado con ID: " . $userId . "\n";
        }else{
            echo "Usuario con ID " .$userId. " ya existe en el repositorio";
        }
    }

    public function update(User $user)
    {
        $userId = $user->getId();

        // Buscar el usuario en el repositorio por su ID
        $existingUser = $this->findUserById($userId);

        // Verificar si el usuario existe
        if ($existingUser !== null) {
            // Actualizar la información del usuario
            $existingUser->setName($user->getName());
            $existingUser->setEmail($user->getEmail());
            $existingUser->setPassword($user->getPassword());
        } else {
            throw new \Exception("El usuario con ID {$user->getId()} no existe.");
        }
    }

    public function delete($userId)
    {
        // Verifica si el usuario con el ID proporcionado existe en el repositorio
        if (array_key_exists($userId, $this->users)) {
            // Si existe, elimina el usuario del repositorio
            unset($this->users[$userId]);
            echo "Usuario con ID $userId eliminado correctamente.\n";
        } else {
            echo "No se encontró un usuario con ID $userId en el repositorio.\n";
        }
    }

    public function findUserById($userId)
    {
        foreach ($this->users as $existingUser) {
            if ($existingUser->getId() === $userId) {
                return $existingUser;
            }
        }

        return null; // El usuario no se encontró
    }
}
