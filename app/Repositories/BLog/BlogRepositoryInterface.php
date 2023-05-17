<?php

namespace App\Repositories\BLog;

use App\Repositories\RepositoryInterface;

interface BlogRepositoryInterface extends   RepositoryInterface
{
    public function getLatestBlogs($limit = 3);
}
