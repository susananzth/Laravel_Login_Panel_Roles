<?php

namespace Tests\Feature\Livewire;

use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\DocumentTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DocumentTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('document_types'))
            ->assertSeeLivewire(DocumentTypes::class);
    }

    public function test_document_type_list_page_is_displayed_and_displays_document_types(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $document_type = DocumentType::factory()->create();

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->assertSee($document_type->name)
            ->assertStatus(200);
    }

    public function test_create_document_type_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->call('create')
            ->assertSee(__('Create new document type'))
            ->assertStatus(200);
    }

    public function test_store_document_type(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->set('name', 'Nuevo')
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/document');

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->assertSee('Nuevo')
            ->assertStatus(200);
    }

    public function test_edit_document_type_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $document_type = DocumentType::factory()->create();

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->call('edit', $document_type->id)
            ->assertSee($document_type->name)
            ->assertStatus(200);
    }

    public function test_update_document_type(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $document_type = DocumentType::factory()->create();

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->set('document_type_id', $document_type->id)
            ->set('name', 'Nuevo')
            ->set('status', true)
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/document');

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->call('edit', $document_type->id)
            ->assertSee('name', 'Nuevo')
            ->assertStatus(200);
    }

    public function test_delete_document_type(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $document_type = DocumentType::factory()->create();

        Livewire::actingAs($user)
            ->test(DocumentTypes::class)
            ->set('document_type_id', $document_type->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/document');
    }
}