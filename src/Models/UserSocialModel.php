<?php

namespace App\Models;

class UserSocialModel
{
  private $user_id;
  private $social_id;
  private $link;
  private $created_at;
  private $modified_at;

  // Constructor
  public function __construct($user_id, $social_id, $link, $createdAt, $modifiedAt)
  {
    $this->user_id = $user_id;
    $this->social_id = $social_id;
    $this->link = $link;
    $this->created_at = $createdAt;
    $this->modified_at = $modifiedAt;
  }

  // Factory method to create an instance from an associative array
  public static function createFactory(array $data)
  {
    return new self(
      $data['user_id'] ?? 0,
      $data['social_id'] ?? 0,
      $data['link'] ?? '',
      $data['created_at'] ?? time(),
      $data['modified_at'] ?? time(),
    );
  }

  // Getters
  public function getUserId()
  {
    return $this->user_id;
  }

  public function getSocialId()
  {
    return $this->social_id;
  }

  public function getLink()
  {
    return $this->link;
  }

  // Setters
  public function setUserId($id)
  {
    $this->user_id = $id;
  }

  public function setSocialId($id)
  {
    $this->social_id = $id;
  }

  public function setLink($link)
  {
    $this->link = $link;
  }
}
