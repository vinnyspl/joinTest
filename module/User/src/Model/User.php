<?php

namespace User\Model;

class User
{

    protected $email;
    protected $name;
    protected $id;

    public function exchangeArray(array $data)
    {

        $this->email = $data['email'];
        $this->name= $data['name'];
        $this->id= $data['id'];   

    }
    public function getArrayCopy()
    {
        return [
                'email' => $this->email, 
                'name' => $this->name,
                'id' => $this->id 
        ];  

    }
     public function getId()
    {
       return $this->id;
    }
    public function getName()
    {
       return $this->name;
    }

    public function getEmail()
    {
       return $this->email;
    }
    
}
