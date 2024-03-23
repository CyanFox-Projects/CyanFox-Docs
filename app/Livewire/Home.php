<?php

namespace App\Livewire;

use App\Facades\MarkdownManager;
use Livewire\Component;

class Home extends Component
{
    public $path;

    public $title;

    public $content;

    public $next;

    public $nextTitle;

    public $previous;

    public $previousTitle;

    public function render()
    {
        $filePath = MarkdownManager::getPermalink('/');

        $parser = MarkdownManager::parseMarkdown($filePath);

        $this->title = $parser['title'];
        $this->content = $parser['content'];
        $this->next = $parser['next'];
        $this->nextTitle = $parser['nextTitle'];
        $this->previous = $parser['previous'];
        $this->previousTitle = $parser['previousTitle'];

        return view('livewire.home')
            ->layout('components.layouts.app', ['title' => $this->title]);
    }
}
