<?php

use App\Services\MarkdownParserService;

if (!function_exists('markdown_parser')) {
    function markdown_parser(): MarkdownParserService
    {
        return new MarkdownParserService();
    }
}
