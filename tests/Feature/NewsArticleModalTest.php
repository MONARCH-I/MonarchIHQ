<?php

namespace Tests\Feature;

use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsArticleModalTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_page_renders_successfully()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Monarchi');
        $response->assertSee('Trending');
    }

    public function test_trending_alias_route_renders_blog_page()
    {
        $response = $this->get('/trending');
        $response->assertStatus(200);
        $response->assertSee('Monarchi');
    }

    public function test_internal_and_external_articles_are_displayed()
    {
        $internal = NewsArticle::create([
            'title' => 'Internal Deep Dive on Microgrids',
            'slug' => 'internal-deep-dive-on-microgrids',
            'excerpt' => 'Architecture of edge solar microgrids.',
            'body' => '## Full Article Content\n\nThis is the internal full article text meant for the modal.',
            'category' => 'engineering',
            'author_name' => 'Monarchi Team',
            'read_time_minutes' => 5,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $external = NewsArticle::create([
            'title' => 'External Report on African Telemetry',
            'slug' => 'external-report-african-telemetry',
            'external_url' => 'https://techcrunch.com/2026/08/report',
            'excerpt' => 'External article excerpt from TechCrunch.',
            'body' => 'External placeholder body',
            'category' => 'global_tech',
            'author_name' => 'TechCrunch Desk',
            'read_time_minutes' => 4,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->assertFalse($internal->isExternal());
        $this->assertTrue($external->isExternal());
        $this->assertEquals('techcrunch.com', $external->externalDomain());

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Internal Deep Dive on Microgrids');
        $response->assertSee('External Report on African Telemetry');
        $response->assertSee('https://techcrunch.com/2026/08/report');
    }

    public function test_content_manager_can_create_article_with_external_url()
    {
        $user = User::factory()->create(['role' => 'content_manager']);

        $response = $this->actingAs($user)->post(route('manager.content.news.store'), [
            'title' => 'New Global Cloud Region in Ghana',
            'category' => 'global_tech',
            'external_url' => 'https://bloomberg.com/news/articles/2026/ghana-cloud',
            'excerpt' => 'Major announcement on West African cloud connectivity.',
            'author_name' => 'Bloomberg',
            'read_time_minutes' => 4,
            'is_published' => 1,
        ]);

        $response->assertRedirect(route('manager.content.news'));
        $this->assertDatabaseHas('news_articles', [
            'title' => 'New Global Cloud Region in Ghana',
            'external_url' => 'https://bloomberg.com/news/articles/2026/ghana-cloud',
        ]);
    }
}
