<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    /** @test */
    public function authenticatedUserCanNotSeeEditProductView()
    {
        $this->loginWithSuperAdmin();
        $product = Product::factory()->create()->toArray();
        $response = $this->get($this->getEditProductRoute($product['id']));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('data', fn(AssertableJson $json) =>
                $json->where('name', $product['name'])
                ->etc())->etc());
    }

    /** @test */
    public function unauthenticatedUserCanNotSeeEditProductView()
    {
        $product = Product::factory()->create();
        $response = $this->get($this->getEditProductRoute($product->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticatedAuthorizeUserCanEditProductIfDataIsValid()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image' => $file])->toArray();
        $dataEdit = Product::factory()->make()->toArray();
        $response = $this->put($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('products', $dataEdit);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataEdit['name'])
            ->where('description', $dataEdit['description'])
            ->etc())->etc());
    }

    /** @test */
    public function authenticatedAuthorizeUserCanNotEditProductIfNameFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image' => $file])->toArray();
        $dataEdit = Product::factory()->make(['name' => null, 'image' => $file])->toArray();
        $response = $this->putJson($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))->etc());
    }

    /** @test */
    public function authenticatedAuthorizeUserCanNotEditProductIfPriceFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image' => $file])->toArray();
        $dataEdit = Product::factory()->make(['price' => null, 'image' => $file])->toArray();
        $response = $this->putJson($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('price'))->etc());
    }

    /** @test */
    public function authenticatedAuthorizeUserCanNotEditProductIfDescriptionFieldIsNull()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image' => $file])->toArray();
        $dataEdit = Product::factory()->make(['description' => null, 'image' => $file])->toArray();
        $response = $this->putJson($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('description'))->etc());
    }

    /** @test */
    public function authenticatedAuthorizeUserCanNotEditCateIfImageFieldIsNotImage()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->create('document.pdf', 123, 'application/pdf');
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image' => $file])->toArray();
        $response = $this->putJson($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('image')->has('image'))->etc());
    }

    /** @test */
    public function authenticatedNotAuthorizeUserCanNotEditProduct()
    {
        $this->loginWithUser();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image' => $file])->toArray();
        $response = $this->putJson($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function getEditProductRoute($id)
    {
        return route('products.show', $id);
    }

    public function getUpdateProductRoute($id)
    {
        return route('products.update', $id);
    }
}
