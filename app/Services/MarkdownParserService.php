<?php

namespace App\Services;

use FilesystemIterator;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Renderer\Block\FencedCodeRenderer;
use League\CommonMark\Extension\CommonMark\Renderer\Block\IndentedCodeRenderer;
use League\CommonMark\MarkdownConverter;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\Yaml\Yaml;

class MarkdownParserService
{
    public function parseMarkdown(string $file): array
    {

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer());
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer());

        $markdownConverter = new MarkdownConverter($environment);

        if (!file_exists(base_path($file))) {
            cookie()->queue(cookie()->forget('language'));
            cookie()->queue(cookie()->forever('language', 'en'));
        }

        $contents = file_get_contents(base_path($file));
        $parts = explode('---', $contents, 3);

        $title = '';
        $next = '';
        $nextTitle = '';
        $previous = '';
        $previousTitle = '';
        $content = $contents;

        if (count($parts) >= 3) {
            $frontMatter = Yaml::parse($parts[1]);
            $title = $frontMatter['title'] ?? '';
            $next = $frontMatter['next'] ?? '';
            $nextTitle = $frontMatter['next_title'] ?? '';
            $previous = $frontMatter['previous'] ?? '';
            $previousTitle = $frontMatter['previous_title'] ?? '';
            $content = $parts[2];
        }

        return [
            'title' => $title,
            'next' => $next,
            'nextTitle' => $nextTitle,
            'previous' => $previous,
            'previousTitle' => $previousTitle,
            'content' => $markdownConverter->convert($content)->getContent(),
        ];
    }

    public function getInformation(string $file, string $key): ?string
    {
        $contents = file_get_contents($file);
        $parts = explode('---', $contents, 3);

        if (count($parts) >= 3) {
            $frontMatter = Yaml::parse($parts[1]);

            return $frontMatter[$key] ?? null;
        } else {
            return null;
        }
    }

    public function getPermalink(string $path): ?string
    {
        $language = request()->cookie('language', 'en');
        if (!str_starts_with($path, '/')) {
            $path = '/' . $path;
        }
        $filePath = '';

        $directoryPath = base_path("pages/$language");
        if (!file_exists($directoryPath)) {
            cookie()->queue(cookie()->forget('language'));
            cookie()->queue(cookie()->forever('language', 'en'));
            $directoryPath = base_path("pages/en");
        }
        $directory = new RecursiveDirectoryIterator($directoryPath, FilesystemIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'md') {
                continue;
            }

            $contents = file_get_contents($file->getPathname());
            $parts = explode('---', $contents, 3);

            if (count($parts) >= 3) {
                $frontMatter = Yaml::parse($parts[1]);

                if ($frontMatter['permalink'] == $path) {
                    $filePath = str_replace(base_path(), '', $file);
                }
            }
        }

        if (!$filePath) {
            abort(404);
        }

        return $filePath;
    }
}
