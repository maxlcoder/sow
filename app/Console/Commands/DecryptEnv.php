<?php

namespace App\Console\Commands;

use App\Lib\Util\AesUtil;
use Illuminate\Console\Command;

class DecryptEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:decrypt-env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if (empty(config('aes.key'))) {
            echo 'aes.key 未设置';
            return Command::FAILURE;
        }

        $arr = [
            'DB_PASSWORD',
            'REDIS_PASSWORD',
        ];

        $path = base_path('.env');
        if (!file_exists($path)){
            echo '.env文件不存在';
            return 0;
        }

        $origin = file_get_contents($path);

        foreach ($arr as $key) {
            $secret = env($key);
            if (empty($secret)) {
                continue;
            }
            try {
                $res = AesUtil::decrypt($secret);
            } catch (\Exception $e) {
                echo $key . ' 已经是明文，无需设置' . PHP_EOL;
                continue;
            }
            if (empty($res)) {
                echo $key . ' 已经是明文，无需设置' . PHP_EOL;
            } else {
                echo $key . ' 明文设置' . PHP_EOL;
                $origin = preg_replace('/\n' . $key . '.*=.*\n/', "\n" . $key  . '=' . $res . "\n", $origin);
            }
        }
        file_put_contents($path, $origin);

        return Command::SUCCESS;
    }
}
