<?php

namespace App\Services;

use PDO;

class AuthRepository extends BaseRepository
{
  public function getById(int $id)
  {
    $this->query('select * from users where id = :id');
    $this->bind(':id', intval($id), PDO::PARAM_INT);
    return $this->single();
  }
  public function getAll()
  {
    $this->query("select * from socials");
    return $this->resultSet();
  }
  public function createEntity($entity)
  {

    $this->query("insert into users (id, email, username, password, fullname, age, address, birthday, gender) values (:id, :email, :username, :password, :fullname, :age, :address, :birthday, :gender)");

    $this->bind(':id', 0, PDO::PARAM_INT);
    $this->bind(':username', $entity->getUsername());
    $this->bind(':fullname', '');
    $this->bind(':age', 0, PDO::PARAM_INT); // bind as integer
    $this->bind(':address', '');
    $this->bind(':birthday', null);
    $this->bind(':gender', 0);
    $this->bind(':email', $entity->getEmail());
    $this->bind(':password', password_hash($entity->getPassword(), PASSWORD_DEFAULT));

    //3. Execute the statement
    return $this->execute();
  }
  public function updateEntity($entity)
  {
    $this->query("update users set fullname = :fullname, major = :major, phone = :phone, email = :email, avatar = :avatar, url = :url where id = :id");

    // 2. Bind the values to the placeholders
    $this->bind(':id', $entity->getId(), PDO::PARAM_INT);
    $this->bind(':fullname', $entity->getFullname());
    $this->bind(':major', $entity->getMajor());
    $this->bind(':phone', $entity->getPhone());
    $this->bind(':email', $entity->getEmail());
    $this->bind(':avatar', $entity->getAvatar());
    $this->bind(':url', $entity->getUrl());

    //3. Execute the statement
    return $this->execute();
  }
  public function deleteById(int $id) {}
  public function getByEmail(string $email)
  {
    $this->query('select * from users where email = :email');
    $this->bind(':email', $email);
    return $this->single();
  }
}
