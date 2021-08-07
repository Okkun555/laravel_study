<?php

namespace App;

use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;
use phpseclib3\Crypt\Blowfish;

class BlowfishEncrypter implements EncrypterContract
{
  protected $encrypter;
  protected $key;

  public function __construct(string $key)
  {
    $this->key = $key;
    $this->encrypter = new Blowfish('ecb');
    $this->encrypter->setKey($this->key);
  }

  public function encrypt($value, $serialize = true)
  {
    return $this->encrypter->encrypt($value);
  }

  public function decrypt($payload, $unsecialize = true)
  {
    return $this->encrypter->decrypt($payload);
  }

  public function getKey()
  {
    return $this->key;
  }
}
