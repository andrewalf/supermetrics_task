<?php

require __DIR__ . '/vendor/autoload.php';

use App\Commands\Command;
use App\Commands\StatisticsCommand;
use App\Commands\TokenCommand;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$commands = [
    'login' => TokenCommand::class,
    'statistics' => StatisticsCommand::class,
];

$commandName = $argv[1] ?? null;

if (!$commandName || !array_key_exists($commandName, $commands)) {
    echo 'Invalid command name!'.PHP_EOL.PHP_EOL;
    echo 'Available commands: login, statistics'.PHP_EOL;
}

$command = new $commands[$commandName]();

if (!$command instanceof Command) {
    echo 'Invalid command! Command must implement "App\Commands\Command" interface'.PHP_EOL;
}

try {
    // yep, no params passed to commands. Everything is pretty simplified.
    $command->execute();
} catch (Throwable $e) {
    echo 'Oops, error...'.PHP_EOL;
    echo $e->getMessage().PHP_EOL;
}