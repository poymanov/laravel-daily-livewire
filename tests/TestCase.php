<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected const LOGIN_URL = '/login';

    /**
     * @param null $user
     */
    protected function signIn($user = null): void
    {
        $user = $user ?: User::factory()->create();
        $this->actingAs($user);
    }

    /**
     * Создание сущности {@see User}
     *
     * @param array $params Параметры нового объекта
     *
     * @return User
     */
    protected function createUser(array $params = []): User
    {
        return User::factory()->create($params);
    }

    /**
     * Создание сущности {@see Product}
     *
     * @param array $params Параметры нового объекта
     *
     * @return Product
     */
    protected function createProduct(array $params = []): Product
    {
        return Product::factory()->create($params);
    }

    /**
     * Создание сущности {@see Category}
     *
     * @param array $params Параметры нового объекта
     *
     * @return Category
     */
    protected function createCategory(array $params = []): Category
    {
        return Category::factory()->create($params);
    }
}
