<?php 

namespace App\Repositories;

use App\NewsItems;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class NewsItemRepository
 *
 * @package App\Repositories
 */
class NewsItemRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return NewsItems::class;
    }
}