<?php
require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    echo "Please create .env file in tests/ directory.";
    exit(1);
}

require_once 'bootstrap/app.php';
