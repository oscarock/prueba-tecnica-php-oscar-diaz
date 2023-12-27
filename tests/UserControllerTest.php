<?php

namespace Oscarock\PruebaTecnicaOscarDiazPhp\Tests;

use PHPUnit\Framework\TestCase;
use Oscarock\PruebaTecnicaOscarDiazPhp\UserController;
use Oscarock\PruebaTecnicaOscarDiazPhp\User;
use Oscarock\PruebaTecnicaOscarDiazPhp\UserRepository;

class UserControllerTest extends TestCase
{
    public function testCreateUser()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->expects($this->once())->method('save');

        $userController = new UserController($userRepositoryMock);
        $userController->createUser(2, 'Oscar Diaz', 'oscarock02@gmail.com', '123456');
    }

    public function testUpdateUser()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->expects($this->once())->method('findUserById')->willReturn(new User(1, 'Oscar Diaz', 'oscarock02@gmail.com', '123456'));
        $userRepositoryMock->expects($this->once())->method('update');

        $userController = new UserController($userRepositoryMock);
        $userController->updateUser(2, 'Oscar Updated', 'oscarock02@gmail.com', '123456789');
    }

    public function testDeleteUser()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->expects($this->once())->method('findUserById')->willReturn(new User(1, 'Oscar Diaz', 'oscarock02@gmail.com', '123456'));
        $userRepositoryMock->expects($this->once())->method('delete');

        $userController = new UserController($userRepositoryMock);
        $userController->deleteUser(2);
    }

    public function testDeleteNonExistingUserThrowsException()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->expects($this->once())->method('findUserById')->willReturn(null);

        $this->expectException(\Exception::class);

        $userController = new UserController($userRepositoryMock);
        $userController->deleteUser(1);
    }
}
