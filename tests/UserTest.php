<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use \App\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanIReadAllUsers()
    {

        $response = $this->get('/api/users');
        return $response->seeJsonStructure([
            'data' => ['*' =>
                [
                    'name',
                    'email',
                    'document_number',
                    'phone_number',
                    'country'
                ]
            ]            
        ]);

    }

    public function testCanIPostSomeUser()
    {
        $user = factory('App\User')->make();

        $data = $user->toArray();
        $response = $this->post('/api/users', $data);
        $response->seeJsonStructure(['data' => ['id']]);
    }

    public function testCanIRetrieveASpeficicUser()
    {
        $user = factory('App\User')->make();
        $data = $user->toArray();

        $response = $this->post('/api/users', $data);
        $response->seeJsonStructure(['data' => ['id']]);
        $generatedUser = $response->response->getOriginalContent();

        $response = $this->get('/api/users/' . $generatedUser->id);
        $response->seeJsonStructure(['data' => ['id', 'name', 'email', 'document_number','phone_number','country']]);
    }

    public function testCanIUpdateASpecificUser()
    {
        $user = factory('App\User')->make();
        $data = $user->toArray();

        $response = $this->post('/api/users', $data);
        $response->seeJsonStructure(['data' => ['id']]);
        $generatedUser = $response->response->getOriginalContent();

        $data = [
            'name' => 'Teste',
            'email' => 'teste@gmail.com',
            'document_number' => '12345678',
            'phone_number' => '17999999999',
            'country' => 'BR'
        ];

        $response = $this->put('/api/users/' . $generatedUser->id, $data);

        return $response->seeInDatabase('users', $data);
    }

    public function testCanIDeleteASpecificUser()
    {
        $user = factory('App\User')->make(['email' => 'teste@gmail.com']);
        $data = $user->toArray();

        $response = $this->post('/api/users', $data);
        $response->seeJsonStructure(['data' => ['id']]);
        $generatedUser = $response->response->getOriginalContent();

        $response = $this->delete('/api/users/' . $generatedUser->id);
        $response->assertResponseOk();

        $this->notSeeInDatabase('users', ['id' => $generatedUser->id]);
    }

    public function testCheckIfIsEmailDuplicating()
    {
        $user = factory('App\User')->make(['email' => 'teste@gmail.com']);
        $data = $user->toArray();

        $response = $this->post('/api/users', $data);
        $response->seeJsonStructure(['data' => ['id']]);

        $response = $this->post('/api/users',$data);
        $response->seeStatusCode(422);
    }


}