<?php

namespace App\Facades;

use App\Services\MarkdownParserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array parseMarkdown(string $file)
 * @method static string|null getInformation(string $file, string $key)
 * @method static string getPermalink(string $path)
 */
class MarkdownManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MarkdownParserService::class;
    }
}
