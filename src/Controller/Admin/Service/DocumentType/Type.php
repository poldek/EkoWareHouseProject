<?php

namespace App\Controller\Admin\Service\DocumentType;

class Type

{
    private const TYPE_PZ = 'PZ';
    private const TYPE_WZ = 'WZ';

    public function typeDocumentName(): array
    {
        return [
            [
                'name' => self::TYPE_PZ,
                'type' => 0
            ],
            [
                'name' => self::TYPE_WZ,
                'type' => 1
            ],
        ];
    }
}
