<?php

namespace App\Bases\Fetch;

class FetchBase
{
    protected string $model;

    public function fetchList()
    {
        return $this->model::get();
    }
    public function fetchById(int $id)
    {
        return $this->getRowById($id);
    }
    protected function getRowById(int $id)
    {
        $row = $this->model::whereId($id)->first();
        if (!$row) {
            throw new \Exception(__('message.not_found'));
        }
        return $row;
    }
    protected function filterById(int $id)
    {
        return $this->model::whereId($id)->first();
    }
}
