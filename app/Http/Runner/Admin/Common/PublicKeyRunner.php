<?php

namespace App\Http\Runner\Admin\Common;

use App\Http\Runner\Runner;
use App\Lib\Util\RsaUtil;

class PublicKeyRunner implements Runner
{
    public function run($request)
    {
        return ['content' => RsaUtil::getPublicKey()];
    }
}
