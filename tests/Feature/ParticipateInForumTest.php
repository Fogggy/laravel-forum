<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);

    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {

        // Given we have a authenticated user
        $this->signIn();

        // And an existing thread
        $thread = create('App\Thread');

        // When the user adds a reply to the thread
        $reply = make('App\Reply');
        $this->post("/threads/{$thread->id}/replies", $reply->toArray());

        // Then their reply should be visible on the page
        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->signIn()->withExceptionHandler();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post("/threads/{$thread->id}/replies", $reply->toArray())
            ->assertSessionHasErrors('body');
    }

}
