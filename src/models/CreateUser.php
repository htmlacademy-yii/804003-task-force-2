<?php
namespace app\models;

class CreateUser 
{

    private $name;
    private $email;
    private $town;
    private $password;
    private $role;

    public function __construct(string $name, string $email, string $town, string $location, string $password, string $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->town = $town;
        $this->location = $location;
        $this->password = $password;
        $this->role = $role;

        $this->validate();
        $this->createUser();
    }

    public function createUser()
    {
        /*сохранение в БД*/
    }

    public function validate()
    {
        /*проверки*/
    }
}