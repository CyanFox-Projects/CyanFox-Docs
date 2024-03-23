<?php

return [
    'enabled' => env('GITHUB_SYNC_ENABLED', false),
    'repo' => env('GITHUB_REPO'),
    'access_token' => env('GITHUB_ACCESS_TOKEN'),
    'branch' => env('GITHUB_BRANCH', 'main'),
];
