<?php

namespace App\Providers;

use App\Github\Repositories\IssueRepository;
use App\Github\Repositories\IssueRepositoryInterface;
use Github\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IssueRepositoryInterface::class, static function() {
            return new IssueRepository(app()->make(Client::class));
        });
    }
}
