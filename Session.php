<?php

interface SessionInterface
{
  public static function start(): void;
  public static function set(string $key, mixed $value, ?bool $redirect): void;
  public static function get(string $key): mixed;
  public static function check(string $key): bool;
  public static function destroy(): void;
  public static function checkLogin(): void;
}


/**
 * Class Session
 */
class Session implements SessionInterface
{
  /**
   * Start session
   * @return void
   */
  public static function start(): void
  {
    if (session_status() == PHP_SESSION_NONE) {
      ini_set('session.gc_maxlifetime', 1800);
      session_start();
    }
  }

  /**
   * Set session
   * @param string $key
   * @param mixed $value
   * @param ?bool $redirect
   * @return void
   */
  public static function set(string $key, mixed $value, ?bool $redirect): void
  {
    self::start();
    $_SESSION[$key] = $value;
    if ($redirect) {
      header('Location: index.php');
      exit;
    }
  }

  /**
   * Get session
   * @param string $key
   * @param bool|null $redirect
   * @return mixed
   */
  public static function get(string $key, ?bool $redirect = true): mixed
  {
    self::start();
    if ($redirect && !isset($_SESSION[$key])) {
      header('Location: login.php');
      exit;
    }
    return $_SESSION[$key] ?? false;
  }

  /**
   * Check session
   * @param string $key
   * @return bool
   */
  public static function check(string $key): bool
  {
    self::start();
    if (!isset($_SESSION[$key])) {
      self::destroy();
      header('Location: login.php');
      exit;
    }
    return true;
  }

  /**
   * Destroy session
   * @return void
   */
  public static function destroy(): void
  {
    self::start();
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
  }

  /**
   * Check login
   * @return void
   */
  public static function checkLogin(): void
  {
    self::start();
    if (self::get('user', false)) {
      header('Location: index.php');
      exit;
    }
  }
}