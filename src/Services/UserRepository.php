<?php

namespace App\Services;

use PDO;

class UserRepository extends BaseRepository
{
  public function getById(int $id)
  {
    $this->query("select * from users where id = :id");
    $this->bind(":id", $id, PDO::PARAM_INT);
    return $this->single();
  }
  public function getAll()
  {
    $this->query("select * from users");
    return $this->resultSet();
  }
  public function createEntity($entity)
  {

    // 1. Prepare the SQL statement with placeholder
    $this->query("insert into users (id, username, fullname, age, address, birthday, gender) values (:id, :username, :fullname, :age, :address, :birthday, :gender)");

    // 2. Bind the values to the placeholders
    $this->bind(':id', 0, PDO::PARAM_INT);
    $this->bind(':username', $entity->getUsername());
    $this->bind(':fullname', $entity->getFullname());
    $this->bind(':age', $entity->getAge(), PDO::PARAM_INT); // bind as integer
    $this->bind(':address', $entity->getAddress());
    $this->bind(':birthday', $entity->getBirthday());
    $this->bind(':gender', $entity->getGender());

    //3. Execute the statement
    return $this->execute();
  }
  public function updateEntity($entity)
  {
    // 1. Prepare the SQL statement with placeholder
    $this->query("update users set username = :username, fullname = :fullname, age = :age, address = :address, birthday = :birthday, gender = :gender where id = :id");

    // 2. Bind the values to the placeholders
    $this->bind(':id', $entity->getId(), PDO::PARAM_INT);
    $this->bind(':username', $entity->getUsername());
    $this->bind(':fullname', $entity->getFullname());
    $this->bind(':age', $entity->getAge(), PDO::PARAM_INT); // bind as integer
    $this->bind(':address', $entity->getAddress());
    $this->bind(':birthday', $entity->getBirthday());
    $this->bind(':gender', $entity->getGender());

    //3. Execute the statement
    return $this->execute();
  }
  public function deleteById(int $id)
  {
    // Call the model to delete the user
    // Prepare and execute the DELETE SQL statement
    $this->query("delete from users where id = :id");
    $this->bind(':id', $id, PDO::PARAM_INT);
    //3. Execute the statement
    return $this->execute();
  }
}
