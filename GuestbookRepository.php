<?php

abstract class GuestbookRepository
{

    /**
     * @param GuestbookMessage $model
     *
     * @return bool
     */
    abstract public function add($model);

    /**
     * @param int $page
     * @return GuestbookMessage[]
     */
    abstract public function getAll($page);

}