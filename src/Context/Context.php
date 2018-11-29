<?php
namespace Cubex\Context;

use Packaged\Config\ConfigProviderInterface;
use Packaged\Config\Provider\ConfigProvider;
use Packaged\Helpers\System;
use Symfony\Component\HttpFoundation\ParameterBag;

class Context
{
  protected $_id;
  protected $_projectRoot;
  protected $_env;
  protected $_cfg;
  protected $_meta;
  /**
   * @var bool
   */
  protected $_isCli;

  const ENV_PHPUNIT = 'phpunit';
  const ENV_LOCAL = 'local';
  const ENV_DEV = 'dev';
  const ENV_QA = 'qa';
  const ENV_UAT = 'uat';
  const ENV_STAGE = 'stage';
  const ENV_PROD = 'prod';

  public final function __construct()
  {
    // Give this context an ID
    $this->_id = uniqid('ctx-', true);

    $this->_meta = new ParameterBag();
    $this->_cfg = new ConfigProvider();

    //Calculate the environment
    $this->_env = getenv('CUBEX_ENV');
    if(($this->_env === null || !$this->_env) && isset($_ENV['CUBEX_ENV']))
    {
      $this->_env = $_ENV['CUBEX_ENV'];
    }
    if($this->_env === null || !$this->_env)//If there is no environment available, assume local
    {
      $this->_env = self::ENV_LOCAL;
    }

    //Is running as CLI?
    $this->_isCli = !System::isFunctionDisabled('php_sapi_name') && php_sapi_name() === 'cli';
  }

  public function setProjectRoot($root)
  {
    $this->_projectRoot = $root;
    return $this;
  }

  public function getProjectRoot()
  {
    return $this->_projectRoot;
  }

  public function getId()
  {
    return $this->_id;
  }

  public function getEnvironment()
  {
    return $this->_env;
  }

  public function isCli()
  {
    return $this->_isCli;
  }

  /**
   * @return ParameterBag
   */
  public function meta()
  {
    return $this->_meta;
  }

  /**
   * @param ConfigProviderInterface $config
   *
   * @return $this
   */
  public function setConfig(ConfigProviderInterface $config)
  {
    $this->_cfg = $config;
    return $this;
  }

  /**
   * @return ConfigProviderInterface
   */
  public function config()
  {
    return $this->_cfg;
  }
}