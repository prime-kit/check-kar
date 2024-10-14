<?php

namespace PrimeKit\CheckKar\Commands;

use Illuminate\Console\Command;

class CheckKarCommand extends Command
{
    public $signature = 'check-kar';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
