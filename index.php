<?php

require_once 'vendor/autoload.php';

use Oscarock\PruebaTecnicaOscarDiazPhp\User;
use Oscarock\PruebaTecnicaOscarDiazPhp\UserRepository;

//crea el usuario
$user = new User(5, "Oscar Diaz", "oscarock02@gmail.com", "123456");
$userRepository = new UserRepository();
$userRepository->save($user);

// Actualizar el usuario en el repositorio
$updatedUser = new User(5, "Oscar Felipe Diaz", "oscarock02@gmail.com", "123456789");
$userRepository->update($updatedUser);

$updatedUserFromRepository = $userRepository->findUserById(5);

echo "Nombre actualizado: " . $updatedUserFromRepository->getName() . "\n";
echo "Correo electrónico actualizado: " . $updatedUserFromRepository->getEmail() . "\n";
echo "Contraseña actualizada: " . $updatedUserFromRepository->getPassword() . "\n";

//elimina el usuario
$userRepository->delete(5);


