<?php
namespace app\models;

class ModifyUser 
{

    private $id;
    private $name;
    private $email;
    private $town;
    private $password;
    private $role;

    private $avatar;
	private $phone;
    private $telegram;

    public function __construct(int $id, string $name, string $email, string $town, string $location, string $password, string $role, string $avatar, string $phone, string $telegram)
    {
        
        $this->name = $name;
        $this->email = $email;
        $this->town = $town;
        $this->location = $location;
        $this->password = $password;
        $this->role = $role;
        $this->avatar = $avatar;
        $this->phone = $phone;
        $this->telegram = $telegram;

        $this->validate();
        $this->modifyUser();
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