<?php

namespace Magedia\WhiteList\Api;

interface WhiteListRepositoryInterface
{
    /**
     * @param int[] $ids
     * @return int
     */
    public function delete($ids): int;

    /**
     * @param[] $data
     * @return void
     */
    public function save($data): void;

    /**
     * @return bool
     */
    public function inWhiteList(): bool;
}
