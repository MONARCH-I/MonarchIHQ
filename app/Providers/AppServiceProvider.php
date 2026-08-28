<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Azure\AzureExtendSocialite;

use App\Models\NewsArticle;
use App\Models\PortfolioProject;
use App\Models\JobListing;
use App\Models\ContactMessage;

use App\Policies\NewsArticlePolicy;
use App\Policies\PortfolioProjectPolicy;
use App\Policies\JobListingPolicy;
use App\Policies\ContactMessagePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(SocialiteWasCalled::class, AzureExtendSocialite::class);

        // ── ABAC Policies ────────────────────────────────────────────────────
        Gate::policy(NewsArticle::class,      NewsArticlePolicy::class);
        Gate::policy(PortfolioProject::class, PortfolioProjectPolicy::class);
        Gate::policy(JobListing::class,       JobListingPolicy::class);
        Gate::policy(ContactMessage::class,   ContactMessagePolicy::class);
    }
}
