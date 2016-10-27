<?php
/**
 * User: Humber Team
 * Date: 25/10/16
 * Time: 11:45 PM
 */

namespace Humber\Controllers;
use Interop\Container\ContainerInterface;

class BaseController
{
  /* @var ContainerInterface */
  protected $ci ;
  public function __construct(ContainerInterface $ci) {
    $this->ci = $ci;
  }
}