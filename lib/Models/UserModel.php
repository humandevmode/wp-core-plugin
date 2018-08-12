<?php

namespace Core\Models;

use Core\Exceptions\UserNotFound;
use Core\Traits\MetaData;
use WP_User;

class UserModel
{
  use MetaData;

  protected $user;
  protected static $current;

  public function __construct(WP_User $user)
  {
    $this->user = $user;
  }

  public function getMetaType()
  {
    return 'user';
  }

  public function getUser()
  {
    return $this->user;
  }

  public function getID()
  {
    return $this->user->ID;
  }

  public function getLogin()
  {
    return $this->user->user_login;
  }

  public function getNiceName()
  {
    return $this->user->user_nicename;
  }

  public function getEmail()
  {
    return $this->user->user_email;
  }

  public function getDisplayName()
  {
    return $this->user->display_name;
  }

  public function getRegistered()
  {
    return $this->user->user_registered;
  }

  public function getActivationKey()
  {
    return $this->user->user_activation_key;
  }

  public function getStatus()
  {
    return $this->user->user_status;
  }

  /**
   * @return static
   */
  public static function getCurrent()
  {
    if (!isset(static::$current)) {
      static::$current = new static(wp_get_current_user());
    }

    return static::$current;
  }

  /**
   * @param int $id
   *
   * @return UserModel
   * @throws UserNotFound
   */
  public static function findByID(int $id)
  {
    $user = get_user_by('id', $id);

    if ($user instanceof WP_User) {
      return new static($user);
    }

    throw new UserNotFound("User with id {$id} not found");
  }
}
