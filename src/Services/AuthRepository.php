<?php

namespace App\Services;

use PDO;

class AuthRepository extends BaseRepository
{
  public function getById(int $id)
  {
    $this->query('SELECT *
              FROM users AS u
              LEFT JOIN users_socials AS us ON us.user_id = u.id
              LEFT JOIN socials AS s ON s.id = us.social_id
              WHERE u.id = :id');

    // Bind the parameter
    $this->bind(':id', $id, PDO::PARAM_INT);

    // Execute the query and get results
    $results = $this->resultSet();

    // Initialize user data
    $user = null;

    // Initialize an array for social accounts
    $socials = [];

    // Process results
    foreach ($results as $row) {
      if (!$user) {
        // Create user object once
        $user = [
          'id' => $row['id'],
          'fullname' => $row['fullname'],
          'phone' => $row['phone'],
          'major' => $row['major'],
          'email' => $row['email'],
          'url' => $row['url'],
          'avatar' => $row['avatar'],
          'socials' => [] // Initialize an empty array for socials
        ];
      }

      // Append social link if exists
      if (!empty($row['social_id']) && !empty($row['link'])) {
        $socials[] = [
          'social_id' => $row['social_id'],
          'link' => $row['link'],
          'base_url' => $row['base_url'],
          'name' => $row['name'] // assuming `name` is a field in your `socials` table
        ];
      }
    }

    // Attach socials to user if user is found
    if ($user) {
      $user['socials'] = $socials; // Assign the social accounts to the user
    }

    return $user;
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
  public function createAssociateSocial($entity)
  {
    $this->query("insert into users_socials (user_id, social_id, link, created_at, modified_at) values (:user_id, :social_id, :link, :created_at, :modified_at)");

    $this->bind(':user_id', $entity->getUserId(), PDO::PARAM_INT);
    $this->bind(':social_id', $entity->getSocialId(), PDO::PARAM_INT);
    $this->bind(':link', $entity->getLink());
    $this->bind(':created_at', date("Y-m-d H:i:s", time())); // bind as integer
    $this->bind(':modified_at', date("Y-m-d H:i:s", time()));

    //3. Execute the statement
    return $this->execute();
  }
}
