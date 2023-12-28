<?php

namespace Oscarock\PruebaTecnicaOscarDiazPhp\Controller;
use Oscarock\PruebaTecnicaOscarDiazPhp\Repository\UserRepository;
use Oscarock\PruebaTecnicaOscarDiazPhp\Model\User;

class UserController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($id, $name, $email, $password)
    {
        $user = new User($id, $name, $email, $password);
        $this->userRepository->save($user);
    }

    public function updateUser($id, $name, $email, $password)
    {
        $existingUser = $this->userRepository->findUserById($id);

        if ($existingUser !== null) {
            $updatedUser = new User($id, $name, $email, $password);
            $this->userRepository->update($updatedUser);
        } else {
            throw new \Exception("El usuario con ID { $id } no existe.");
        }
    }

    public function deleteUser($id)
    {
        $existingUser = $this->userRepository->findUserById($id);

        if ($existingUser !== null) {
            $this->userRepository->delete($id);
        } else {
            throw new \Exception("El usuario con ID { $id } no existe.");
        }
    }
}
