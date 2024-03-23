<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CloneGithubRepoCommand extends Command
{
    protected $signature = 'github:clone';

    protected $description = 'Clone GitHub repository';

    public function handle()
    {
        if (!config('github.enabled')) {
            $this->info('GitHub sync is disabled in the configuration');

            return;
        }

        $githubRepo = config('github.repo');
        $targetPath = base_path('pages');
        $githubToken = config('github.access_token');
        $githubBranch = config('github.branch');

        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $this->info('Cleaning the previous cloned repo in pages directory...');
        File::deleteDirectory($targetPath);

        $this->info('Cloning GitHub repository to pages directory...');

        $repoSegments = explode('//', $githubRepo, 2);
        $repoUrlWithAccessToken = $repoSegments[0].'//'.$githubToken.'@'.$repoSegments[1];
        $process = new Process([
            'git', 'clone', '--branch', $githubBranch, $repoUrlWithAccessToken, $targetPath,
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('Successfully cloned GitHub repository to pages directory');
    }
}
