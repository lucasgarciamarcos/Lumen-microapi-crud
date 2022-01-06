<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanListUsers()
    {
        // Prepare
        User::factory(5)->create();

        // Act
        $result = $this->post('/users');

        // Assert
        $result->assertResponseOk();
    }

    public function testCanSearchUsers()
    {
        // Prepare
        $user = User::factory()->create();
        $payload = [
            'email' => 'lucasgmarcos@gmail.com',
            'password' => 'ssss33x1'
        ];
        User::create($payload);

        // Act
        $result = $this->post('/users', ['search' => 'lucas']);

        // Assert
        $result->assertResponseOk();
        $result->seeJsonDoesntContains($user->toArray());
        $result->seeJsonContains($payload);
    }

    public function testUserCanCreate()
    {
        // Prepare
        $payload = [
            'email' => 'lucasgmarcos@gmail.com',
            'password' => 'ssss33x1'
        ];
        
        // Act
        $result = $this->post('/users/create', $payload);

        // Assert
        $result->assertResponseStatus(201);
        $result->seeInDatabase('users', $payload);
    }

    public function testUserMustSendEmailAndPassword()
    {
        // Prepare
        $payload = [
            'teste' => 'teste',
        ];
        
        // Act
        $result = $this->post('/users/create', $payload);

        // Assert
        $result->assertResponseStatus(422);
    }

    public function testCanRetrieveUser()
    {
        // Prepare
        $user = User::factory()->create();
        
        // Act
        $uri = '/users/get/' . $user->id;
        $result = $this->get($uri);

        // Assert
        $result->assertResponseOk();
        $result->seeJsonContains(['email' => $user->email]);
    }

    public function testRetrieveInvalidUser()
    {
        // Prepare
        
        // Act
        $result = $this->get('/users/get/12452532452342');

        // Assert
        $result->seeJsonContains(['error' => 'User not found']);
    }

    public function testCanDeleteUser()
    {
        // Prepare
        $user = User::factory()->create();
        
        // Act
        $uri = '/users/delete/' . $user->id;
        $result = $this->get($uri);

        // Assert
        $result->assertResponseStatus(204);
        $result->notSeeInDatabase('users', [
            'id' => $user->id
        ]);
    }

    public function testCanUpdateUser()
    {
        // Prepare
        $user = User::factory()->create()->toArray();
        $user['password'] = 'ssss33x1';
        
        // Act
        $result = $this->post('/users/update/' . $user['id'], $user);

        // Assert
        $result->assertResponseStatus(201);
        $result->seeInDatabase('users', [
            'id' => $user['id'],
            'password' => $user['password'],
            'email' => $user['email'],
        ]);
    }
}
