<?php

declare(strict_types=1);

use Doctum\RemoteRepository\GitHubRemoteRepository;

return new Doctum\Doctum(__DIR__ . '/src', [
    'title'                => 'ReMix API Documentation',
    'build_dir'            => __DIR__ . '/docs',
    'cache_dir'            => __DIR__ . '/.doctum.cache',
    'default_opened_level' => 2,
    'remote_repository'    => new GitHubRemoteRepository('ExeQue/remix', __DIR__),
    'base_url'             => 'https://exeque.github.io/remix/',
]);
