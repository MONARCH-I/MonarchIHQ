<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitemapTest extends TestCase
{
    public function test_sitemap_returns_valid_xml_response(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $response->getContent());
        $this->assertStringContainsString('<urlset', $response->getContent());
        $this->assertStringContainsString('/services', $response->getContent());
        $this->assertStringContainsString('/about', $response->getContent());
        $this->assertStringContainsString('/store', $response->getContent());
        $this->assertStringContainsString('/contact', $response->getContent());
    }
}
