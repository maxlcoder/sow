<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRsaKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-rsa-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!is_dir(resource_path() . '/cert')) mkdir(resource_path() . '/cert');

        $publicKeyFile = resource_path() . '/cert/rsa_public.pem';
        // 检测rsa key 文件是否存在
        if (file_exists($publicKeyFile)) {
            echo 'RSA公钥已存在' . PHP_EOL;
        }

        $privateKeyFile = resource_path() . '/cert/rsa_private.pem';
        // 检测rsa key 文件是否存在
        if (file_exists($publicKeyFile)) {
            echo 'RSA私钥已存在' . PHP_EOL;
        }

        $config = [
            "digest_alg" => "sha256",
            "private_key_bits" => 512, // 字节数  512 1024 2048  4096 等
            "private_key_type" => OPENSSL_KEYTYPE_RSA, // 加密类型
        ];
        $res = openssl_pkey_new($config);
        openssl_pkey_export_to_file($res, $privateKeyFile);

        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];

        file_put_contents($publicKeyFile, $pubKey);

        return Command::SUCCESS;
    }
}
