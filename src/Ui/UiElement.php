<?php
namespace Cubex\Ui;

use Composer\Autoload\ClassLoader;
use Cubex\Context\ContextAware;
use Cubex\Context\ContextAwareTrait;
use Packaged\Ui\Element;

class UiElement extends Element implements ContextAware
{
  use ContextAwareTrait;

  protected function getTemplateFilePath()
  {
    if($this->_templateFilePath === null && $this->hasContext())
    {

      if($this->hasContext())
      {
        try
        {
          $loader = $this->getContext()->getCubex()->retrieve(ClassLoader::class);
          if($loader instanceof ClassLoader)
          {
            $filePath = $loader->findFile(static::class);
            if($filePath)
            {
              $this->_templateFilePath = realpath(substr($filePath, 0, -3) . 'phtml');
            }
          }
        }
        catch(\Throwable $e)
        {
        }
      }
    }

    if($this->_templateFilePath === null)
    {
      return parent::getTemplateFilePath();
    }

    return $this->_templateFilePath;
  }
}