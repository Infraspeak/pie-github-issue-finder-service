<?php

namespace App\Github\Console\Commands;

use App\Github\Repositories\IssueRepository;
use App\Github\Schema\Repo;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ListenRepositoryRedisChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:listen-repositories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to REPO_GITHUB.COM redis channel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        Redis::subscribe(['REPO_GITHUB.COM'], function(string $message) {
            try {
                $request = json_decode($message);

                $repo = new Repo($request->payload->name, $request->payload->url, $request->payload->version);

                $issues = app()->make(IssueRepository::class)->getOpenIssues($repo);

                $response = [
                    'headers' => $request->headers,
                    'payload' => [
                        'repo' => $repo,
                        'issues' => $issues,
                    ]
                ];

                Redis::connection('publish')->publish('ISSUES', json_encode($response));
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        });
    }
}
