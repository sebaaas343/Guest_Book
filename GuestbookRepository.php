<?php

abstract class GuestbookRepository
{

    /**
     * @return int
     */
    public function getNextId() {
        return count($this->getAll()) + 1;
    }

    /**
     * @param GuestbookMessage $model
     *
     * @return bool
     */
    abstract public function add($model);

    /**
     * @return GuestbookMessage[]
     */
    abstract public function getAll();

}