<?php

namespace Oscarock\PruebaTecnicaOscarDiazPhp\Tests;

use PHPUnit\Framework\TestCase;
use Oscarock\PruebaTecnicaOscarDiazPhp\User;
use Oscarock\PruebaTecnicaOscarDiazPhp\UserRepository;

class UserTest extends TestCase
{
    public function testGetName()
    {
        $user = new User(5, "Oscar Diaz", "oscarock02@gmail.com", "123456");
        $this->assertEquals("Oscar Diaz", $user->getName());
    }

    public function testSaveUser()
    {
        // Crea un usuario para agregar al repositorio
        $user = new User(1, 'Oscar Diaz', 'oscarock02@gmail.com', 'password');

        // Crea el repositorio y guarda el usuario
        $repository = new UserRepository();
        $repository->save($user);

        // Obtiene el usuario del repositorio después de la save
        $resultUser = $repository->findUserById(1);

        // Verifica que la información del usuario se haya guardado correctamente
        $this->assertEquals('Oscar Diaz', $resultUser->getName());
        $this->assertEquals('oscarock02@gmail.com', $resultUser->getEmail());
        $this->assertEquals('password', $resultUser->getPassword());
    }
    public function testSaveDuplicateUser()
    {
        // Crea un usuario para agregar al repositorio
        $user = new User(1, 'Oscar Diaz', 'oscarock02@gmail.com', 'password');

        // Crea el repositorio y guarda el usuario
        $repository = new UserRepository();
        $repository->save($user);

        // Intenta guardar un usuario con el mismo ID (debería mostrar un mensaje de que ya existe)
        $duplicateUser = new User(1, 'Duplicate John', 'duplicate@example.com', 'newpassword');

        // Redirige la salida estándar para capturar el mensaje
        ob_start();
        $repository->save($duplicateUser);
        $output = ob_get_clean();

        // Verifica que se mostró el mensaje correcto
        $this->assertStringContainsString('Usuario con ID 1 ya existe en el repositorio', $output);
    }

    public function testUpdateUser()
    {
        // Crea un usuario para agregar al repositorio
        $user = new User(3, 'Oscar Diaz', 'oscarock02@gmail.com', '123456');

        // Crea el repositorio y guarda el usuario
        $repository = new UserRepository();
        $repository->save($user);

        // Crea un nuevo usuario con información actualizada
        $updatedUser = new User(3, 'Oscar Felipe Diaz', 'oscarock02@gmail.com', '123456789');

        // Actualiza el usuario en el repositorio
        $repository->update($updatedUser);

        // Obtiene el usuario del repositorio después de la actualización
        $resultUser = $repository->findUserById(3);

        // Verifica que la información del usuario se haya actualizado correctamente
        $this->assertEquals('Oscar Felipe Diaz', $resultUser->getName());
        $this->assertEquals('oscarock02@gmail.com', $resultUser->getEmail());
        $this->assertEquals('123456789', $resultUser->getPassword());
    }

    public function testDeleteUser()
    {
        $user = new User(1, 'Oscar Diaz', 'oscarock02@gmail.com', 'password');

        $repository = new UserRepository();
        $repository->save($user);

        // Elimina el usuario del repositorio
        $repository->delete(1);

        // Intenta encontrar al usuario después de la eliminación
        $resultUser = $repository->findUserById(1);

        // Verifica que el usuario se haya eliminado correctamente
        $this->assertNull($resultUser);
    }
    public function testDeleteNonExistingUser()
    {
        // Crea el repositorio
        $repository = new UserRepository();

        // Intenta eliminar un usuario que no existe
        // Redirige la salida estándar para capturar el mensaje
        ob_start();
        $repository->delete(1);
        $output = ob_get_clean();

        // Verifica que se mostró el mensaje correcto
        $this->assertStringContainsString('No se encontró un usuario con ID 1 en el repositorio', $output);
    }
}
