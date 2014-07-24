<?php
namespace Cubex\Facade;

use Cubex\ServiceManager\Services\AuthService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AuthService getFacadeRoot()
 */
class Auth extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'auth';
  }

  /**
   * Logout the user from the current system
   *
   * @return bool
   */
  public static function logout()
  {
    return self::getFacadeRoot()->logout();
  }

  /**
   * Returns is the user is logged in
   *
   * @return bool
   */
  public static function isLoggedIn()
  {
    return self::getFacadeRoot()->isLoggedIn();
  }

  /**
   * @param bool $refresh
   *
   * @return \Cubex\Auth\IAuthedUser
   *
   * @throws \Exception
   * @throws \RuntimeException
   */
  public static function getAuthedUser($refresh = false)
  {
    return self::getFacadeRoot()->getAuthedUser($refresh);
  }

  /**
   * @param       $username
   * @param       $password
   * @param array $options
   *
   * @return \Cubex\Auth\IAuthedUser
   *
   * @throws \Exception
   * @throws \RuntimeException
   */
  public static function login($username, $password, array $options = null)
  {
    return self::getFacadeRoot()->login($username, $password, $options);
  }

  public static function forgottenPassword($username, array $options = null)
  {
    return self::getFacadeRoot()->forgottenPassword($username, $options);
  }
}
