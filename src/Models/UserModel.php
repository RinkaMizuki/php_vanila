<?php

namespace App\Models;

class UserModel
{
  private int $id = 0;
  private string $username;
  private string $fullname;
  private int $age;
  private string $address;
  private string $birthday; // Consider using DateTime if needed
  private bool $gender = false; // Assuming 1 for male and 0 for female
  private string $email;
  private string $password;
  private string $avatar;
  private string $url;
  private string $phone;
  private string $major;

  public static function createFactory(
    int $id,
    string $username,
    string $fullname,
    int $age,
    string $address,
    string $birthday,
    bool $gender = false,
    string $email = '',
    string $password = '',
    string $avatar = '',
    string $url = '',
    string $phone = '',
    string $major = ''
  ): UserModel {
    $user = new UserModel();

    $user->setId($id);
    $user->setUsername($username);
    $user->setFullname($fullname);
    $user->setAge($age);
    $user->setAddress($address);
    $user->setBirthday($birthday);
    $user->setGender($gender);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->setAvatar($avatar);
    $user->setUrl($url);
    $user->setPhone($phone);
    $user->setMajor($major);

    return $user;
  }

  // Getters and setters for each property

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  public function setUsername(string $username): void
  {
    $this->username = $username;
  }

  public function getFullname(): string
  {
    return $this->fullname;
  }

  public function setFullname(string $fullname): void
  {
    $this->fullname = $fullname;
  }

  public function getAge(): int
  {
    return $this->age;
  }

  public function setAge(int $age): void
  {
    $this->age = $age;
  }

  public function getAddress(): string
  {
    return $this->address;
  }

  public function setAddress(string $address): void
  {
    $this->address = $address;
  }

  public function getBirthday(): string
  {
    return $this->birthday;
  }

  public function setBirthday(string $birthday): void
  {
    $this->birthday = $birthday;
  }

  public function getGender(): bool
  {
    return $this->gender;
  }

  public function setGender(bool $gender): void
  {
    $this->gender = $gender;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }

  public function getAvatar(): string
  {
    return $this->avatar;
  }

  public function setAvatar(string $avatar): void
  {
    $this->avatar = $avatar;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function setUrl(string $url): void
  {
    $this->url = $url;
  }

  public function getPhone(): string
  {
    return $this->phone;
  }

  public function setPhone(string $phone): void
  {
    $this->phone = $phone;
  }

  public function getMajor(): string
  {
    return $this->major;
  }

  public function setMajor(string $major): void
  {
    $this->major = $major;
  }
}
