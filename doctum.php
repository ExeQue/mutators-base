<?php

declare(strict_types=1);

use Doctum\RemoteRepository\GitHubRemoteRepository;

return new Doctum\Doctum(__DIR__ . '/src', [
    'title'                 => 'ReMix API Documentation',
    'build_dir'             => __DIR__ . '/docs',
    'cache_dir'             => __DIR__ . '/.doctum.cache',
    'default_opened_level'  => 3,
    'remote_repository'     => new GitHubRemoteRepository('ExeQue/remix', __DIR__),
    'base_url'              => 'https://exeque.github.io/remix/',
    'include_parent_data'   => true,
    'sort_class_properties' => true,
    'sort_class_methods'    => true,
    'sort_class_constants'  => true,
    'sort_class_traits'     => true,
    'sort_class_interfaces' => true,
    'sort_class_uses'       => true,
    'sort_class_implements' => true,
    'sort_class_extends'    => true,

]);
