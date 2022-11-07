<?php

namespace App\Lib\Util;


class RsaUtil
{
    public static function getPublicKey()
    {
        return file_get_contents(resource_path() . '/cert/rsa_public.pem');
    }

    public static function publicEncrypt($decrypt)
    {
        $publicKey = openssl_get_publickey(file_get_contents(resource_path() . '/cert/rsa_public.pem'));
        openssl_public_encrypt($decrypt, $encrypt, $publicKey);
        return $encrypt;
    }

    public static function decrypt($encrypt)
    {
        $privateKey = openssl_get_privatekey(file_get_contents(resource_path() . '/cert/rsa_private.pem'));
        openssl_private_decrypt($encrypt, $decrypt, $privateKey);
        return $decrypt;
    }
}
