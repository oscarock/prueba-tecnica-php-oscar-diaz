<?php

require_once 'vendor/autoload.php';

use Oscarock\PruebaTecnicaOscarDiazPhp\UserController;
use Oscarock\PruebaTecnicaOscarDiazPhp\UserRepository;

// Crea el controlador de usuario con el repositorio
$userRepository = new UserRepository();
$userController = new UserController($userRepository);

// Crea el usuario
$userController->createUser(5, "Oscar Diaz", "oscarock02@gmail.com", "123456");

// Actualiza el usuario
$userController->updateUser(5, "Oscar Felipe Diaz", "oscarock02@gmail.com", "123456789");

// Imprime la información actualizada del usuario
$updatedUser = $userRepository->findUserById(5);
echo "Nombre actualizado: " . $updatedUser->getName() . "\n";
echo "Correo electrónico actualizado: " . $updatedUser->getEmail() . "\n";
echo "Contraseña actualizada: " . $updatedUser->getPassword() . "\n";

// Elimina el usuario
$userController->deleteUser(5);


