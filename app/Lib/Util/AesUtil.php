<?php

namespace App\Lib\Util;

class AesUtil
{

    // 获取key
    public static function getPrivateKey()
    {
        return substr(md5(config('aes.key')), 0, 16);
    }

    // 加密
    public static function encrypt($data = '')
    {
        return bin2hex(base64_decode(openssl_encrypt($data, 'aes-128-ecb', self::getPrivateKey())));
    }

    // 解密
    public static function decrypt($data = '')
    {
        return openssl_decrypt(base64_encode(hex2bin($data)), 'aes-128-ecb', self::getPrivateKey());
    }

    /**
     * 模糊查询字段
     * @param $query        [$query]
     * @param $searchField  [查询字段]
     * @param $searchValue  [查询值]
     */
    public static function searchLikeQuery(&$query, $searchField, $searchValue)
    {
        $key = self::getPrivateKey();
        $query->whereRaw("AES_DECRYPT(UNHEX({$searchField}), '{$key}') LIKE '%{$searchValue}%'");
    }

}