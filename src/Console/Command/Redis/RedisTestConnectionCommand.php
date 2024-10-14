<?php

namespace PrimeKit\CheckKar\Console\Command\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisTestConnectionCommand extends Command
{
    protected $signature = 'redis:test {connection? : The name of the Redis connection to test} {--all : Test all configured Redis connections}';

    protected $description = 'Test Redis connection(s)';

    public function handle()
    {
        $redisConfigs = config('database.redis');

        // Exclude non-connection keys
        $excludeKeys = ['client', 'options'];

        if ($this->option('all')) {
            // Filter out non-connection keys
            $connectionNames = array_diff(array_keys($redisConfigs), $excludeKeys);
        } else {
            $connectionName = $this->argument('connection') ?? 'default';

            if (! isset($redisConfigs[$connectionName]) || in_array($connectionName, $excludeKeys)) {
                $this->error("Redis connection '{$connectionName}' is not defined in your configuration.");

                return;
            }

            $connectionNames = [$connectionName];
        }

        foreach ($connectionNames as $connectionName) {
            $this->info("Testing Redis connection: {$connectionName}");

            try {
                $ping = Redis::connection($connectionName)->ping();

                if (in_array($ping, [true, '+PONG', 'PONG'], true)) {
                    $this->info("Redis connection '{$connectionName}' successful!");
                } else {
                    $this->error("Unexpected response from Redis connection '{$connectionName}': ".var_export($ping, true));
                }
            } catch (\Exception $e) {
                $this->error("Redis connection '{$connectionName}' failed: ".$e->getMessage());
            }
        }
    }
}
