<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Docs;
use Livewire\Livewire;
use Tests\TestCase;

class DocsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Docs::class, ['path' => '/some-page/hello-world'])
            ->assertStatus(200);
    }
}
