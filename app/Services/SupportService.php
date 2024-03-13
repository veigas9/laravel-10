<?php

namespace App\Services;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatus;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    /**
     * Define constructor
     *
     * @param SupportRepositoryInterface $repository
     */
    public function __construct(
        protected SupportRepositoryInterface $repository,
    ) {
    }

    /**
     * Implements paginator
     *
     * @param integer $page
     * @param integer $totalPerPage
     * @param string|null $filter
     * @return PaginationInterface
     */
    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginationInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }

    /**
     * Return all register
     *
     * @param string|null $filter
     * @return array
     */
    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    /**
     * Return one register
     *
     * @param string $id
     * @return stdClass|null
     */
    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    //----------------------Started PATTERN DTO------------------------------------------

    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function updateStatus(string $id, SupportStatus $status): void
    {
        $this->repository->updateStatus($id, $status);
    }
}
