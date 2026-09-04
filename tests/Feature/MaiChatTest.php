<?php

namespace Tests\Feature;

use App\Models\MaiConversation;
use App\Models\MaiMessage;
use App\Models\User;
use App\Services\MaiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class MaiChatTest extends TestCase
{
    use RefreshDatabase;

    private function createSuperAdmin(): User
    {
        return User::factory()->create([
            'role' => 'super_admin',
            'is_super_admin' => true,
        ]);
    }

    private function createRegularManager(): User
    {
        return User::factory()->create([
            'role' => 'store_manager',
            'is_super_admin' => false,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_mai_chat(): void
    {
        $response = $this->postJson(route('manager.mai.chat'), [
            'message' => 'Hello MAI',
        ]);

        $response->assertStatus(401);
    }

    public function test_non_super_admin_is_forbidden_from_mai_chat(): void
    {
        $manager = $this->createRegularManager();

        $response = $this->actingAs($manager)->postJson(route('manager.mai.chat'), [
            'message' => 'How many products do we have?',
        ]);

        $response->assertStatus(403);
    }

    public function test_non_super_admin_is_forbidden_from_conversations_history(): void
    {
        $manager = $this->createRegularManager();

        $response = $this->actingAs($manager)->getJson(route('manager.mai.conversations'));
        $response->assertStatus(403);
    }

    public function test_super_admin_can_chat_and_creates_conversation(): void
    {
        $admin = $this->createSuperAdmin();

        $mockMai = Mockery::mock(MaiService::class);
        $mockMai->shouldReceive('handle')
            ->once()
            ->andReturn([
                'reasoning' => 'Querying products table to count active products.',
                'sql' => 'SELECT count(*) as total FROM products WHERE is_active = true',
                'results_count' => 1,
                'results_preview' => [['total' => 12]],
                'answer' => 'We currently have 12 active products in the store.',
                'error' => null,
            ]);

        $this->app->instance(MaiService::class, $mockMai);

        $response = $this->actingAs($admin)->postJson(route('manager.mai.chat'), [
            'message' => 'How many active products do we have?',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'answer' => 'We currently have 12 active products in the store.',
            'results_count' => 1,
        ]);

        $this->assertDatabaseHas('mai_conversations', [
            'user_id' => $admin->id,
            'title' => 'How many active products do we have?',
        ]);

        $this->assertDatabaseHas('mai_messages', [
            'role' => 'user',
            'content' => 'How many active products do we have?',
        ]);

        $this->assertDatabaseHas('mai_messages', [
            'role' => 'assistant',
            'content' => 'We currently have 12 active products in the store.',
        ]);
    }

    public function test_super_admin_can_retrieve_conversations_list(): void
    {
        $admin = $this->createSuperAdmin();

        $conv = MaiConversation::create([
            'user_id' => $admin->id,
            'title' => 'Sales Analysis Q1',
        ]);

        $response = $this->actingAs($admin)->getJson(route('manager.mai.conversations'));

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'conversations' => [
                [
                    'id' => $conv->id,
                    'title' => 'Sales Analysis Q1',
                ],
            ],
        ]);
    }

    public function test_super_admin_can_load_conversation_messages(): void
    {
        $admin = $this->createSuperAdmin();

        $conv = MaiConversation::create([
            'user_id' => $admin->id,
            'title' => 'Orders Review',
        ]);

        MaiMessage::create([
            'conversation_id' => $conv->id,
            'role' => 'user',
            'content' => 'How many orders are pending?',
        ]);

        MaiMessage::create([
            'conversation_id' => $conv->id,
            'role' => 'assistant',
            'content' => 'You have 3 pending orders.',
            'reasoning' => 'Checked orders where status = pending',
            'sql' => 'SELECT * FROM orders WHERE status = pending',
            'results_count' => 3,
        ]);

        $response = $this->actingAs($admin)->getJson(route('manager.mai.conversation.messages', $conv));

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'conversation_id' => $conv->id,
            'title' => 'Orders Review',
        ]);
        $response->assertJsonCount(2, 'messages');
    }

    public function test_user_cannot_view_another_users_conversation(): void
    {
        $admin1 = $this->createSuperAdmin();
        $admin2 = $this->createSuperAdmin();

        $conv = MaiConversation::create([
            'user_id' => $admin1->id,
            'title' => 'Secret admin 1 chat',
        ]);

        $response = $this->actingAs($admin2)->getJson(route('manager.mai.conversation.messages', $conv));
        $response->assertStatus(403);
    }

    public function test_super_admin_can_delete_conversation(): void
    {
        $admin = $this->createSuperAdmin();

        $conv = MaiConversation::create([
            'user_id' => $admin->id,
            'title' => 'Chat to delete',
        ]);

        MaiMessage::create([
            'conversation_id' => $conv->id,
            'role' => 'user',
            'content' => 'Test message',
        ]);

        $response = $this->actingAs($admin)->deleteJson(route('manager.mai.conversation.delete', $conv));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('mai_conversations', ['id' => $conv->id]);
        $this->assertDatabaseMissing('mai_messages', ['conversation_id' => $conv->id]);
    }

    public function test_webpage_footer_contains_snapchat_and_whatsapp_and_no_github(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        // Verify snapchat & whatsapp exist in footer
        $response->assertSee('snapchat.com/add/monarchihq');
        $response->assertSee('wa.me/233505504793');
        // Verify github link is not present in footer
        $response->assertDontSee('https://github.com/MONARCH-I');
    }
}
