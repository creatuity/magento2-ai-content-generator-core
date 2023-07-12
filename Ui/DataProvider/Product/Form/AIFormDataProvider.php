<?php

declare(strict_types=1);

namespace Creatuity\AIContent\Ui\DataProvider\Product\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class AIFormDataProvider extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return [
            '' => []
        ];
    }
}