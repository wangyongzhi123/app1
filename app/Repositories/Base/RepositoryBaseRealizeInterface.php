<?php

namespace App\Repositories\Base;

interface RepositoryBaseInterface
{
    public function insertByParams(array $data): void;//新增

    public function updateByParams(array $data, array $condition = []): void;//更新

    public function deleteByParams(array $condition = []): void;//删除

    public function getFieldDataByParams($select = ['*'], array $condition = []): array;//多项查询

    public function getSingleDataByParams(array $select = ['*'], array $condition = []): array;//单项查询

    public function getPluckDataByParams(string $key, string $value, array $condition = []): array;//pluck查询
}
