<?php

namespace App\Repositories\Base;

use App\Repositories\Driver\BaseRepositoryTrait;

class RepositoryBaseFuc implements RepositoryBaseInterface
{
    use BaseRepositoryTrait;
    protected $model;

    public function insertByParams(array $data): void
    {
        $this->model->insert($data);
    }

    public function getInsertGetIdByParams(array $data): int
    {
        return $this->model->insertGetId($data);
    }

    public function updateByParams(array $data, array $condition = []): void
    {
        $query = $this->model->where('id', '>', 0);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        $query->update($data);
    }

    public function deleteByParams(array $condition = []): void
    {
        $query = $this->model->where('id', '>', 0);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        $query->delete();
    }

    public function getFieldDataByParams( $select = ['*'], array $condition = []): array
    {
        $query = $this->model->select($select);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        return $query->get()->toArray();
    }

    public function getSingleDataByParams(array $select = ['*'], array $condition = []): array
    {
        $query = $this->model->select($select);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        $data = $query->first();
        if ($data) {
            return $data->toArray();
        } else {
            return [];
        }
    }

    public function getPluckDataByParams(string $key, string $value, array $condition = []): array
    {
        $query = $this->model->where('id', '>', 0);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        return $query->pluck($value, $key)->toArray();
    }
    public function getPluckValuesDataByParams(string $value, array $condition = []): array
    {
        $query = $this->model->where('id', '>', 0);
        self::buildQuery($query, array_merge(self::$defaultQuery,$condition));
        return $query->pluck($value)->toArray();
    }
}
