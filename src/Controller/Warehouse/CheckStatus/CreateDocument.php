<?php

namespace App\Controller\Warehouse\CheckStatus;

use App\Repository\DocumentsRepository;

class CreateDocument
{
    public const PZ = 'PZ';
    public const WZ = 'WZ';

    public function __construct(
        public DocumentsRepository $documentsRepository
    )
    {}

    public function document($type)
    {
        $checkStatus = $this->documentsRepository->findOneBy(
            array('status' => 0, 'type' => $type)
        );

        return $checkStatus;
    }
}
