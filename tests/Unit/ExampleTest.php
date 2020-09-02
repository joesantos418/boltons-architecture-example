<?php

namespace Arquivei\Boltons\Example\Tests;

use Arquivei\Boltons\Example\Modules\User\Creation\Entities\User;
use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\EmailTakenException;
use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\UserSaveException;
use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\CheckUniqueEmailGateway;
use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\UserSaveGateway;
use Arquivei\Boltons\Example\Modules\User\Creation\Requests\Request;
use Arquivei\Boltons\Example\Modules\User\Creation\UseCase;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testSuccess()
    {
        $checkUniqueEmailGateway = $this->createMock(CheckUniqueEmailGateway::class);
        $checkUniqueEmailGateway->expects($this->once())
            ->method('isEmailTaken')
            ->willReturn(false);

        $userSaveGateway = $this->createMock(UserSaveGateway::class);
        $userSaveGateway->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($user) {
                $this->assertSame('name', $user->getName());
                $this->assertSame('email', $user->getEmail());
                $this->assertSame('phone', $user->getPhone());

                return true;
            }))
            ->willReturn('1');

        $useCase = new UseCase($checkUniqueEmailGateway, $userSaveGateway);

        $request = new Request(
            new User('name', 'email', 'phone')
        );

        $response = $useCase->execute($request);
        $this->assertSame('1', $response->getUserId());
    }

    public function testEmailTakenError()
    {
        $this->expectException(EmailTakenException::class);

        $checkUniqueEmailGateway = $this->createMock(CheckUniqueEmailGateway::class);
        $checkUniqueEmailGateway->expects($this->once())
            ->method('isEmailTaken')
            ->willReturn(true);

        $userSaveGateway = $this->createMock(UserSaveGateway::class);

        $useCase = new UseCase($checkUniqueEmailGateway, $userSaveGateway);

        $request = new Request(
            new User('name', 'email', 'phone')
        );

        $response = $useCase->execute($request);
    }

    public function testSaveError()
    {
        $this->expectException(UserSaveException::class);

        $checkUniqueEmailGateway = $this->createMock(CheckUniqueEmailGateway::class);
        $checkUniqueEmailGateway->expects($this->once())
            ->method('isEmailTaken')
            ->willReturn(false);

        $userSaveGateway = $this->createMock(UserSaveGateway::class);
        $userSaveGateway->expects($this->once())
            ->method('save')
            ->willThrowException(new \Exception('Cannot save'));

        $useCase = new UseCase($checkUniqueEmailGateway, $userSaveGateway);

        $request = new Request(
            new User('name', 'email', 'phone')
        );

        $response = $useCase->execute($request);
    }
}
