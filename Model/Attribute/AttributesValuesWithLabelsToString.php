<?php

declare(strict_types=1);

namespace Creatuity\AIContent\Model\Attribute;

class AttributesValuesWithLabelsToString
{
    public function execute(array $data): string
    {
        if (!$data) {
            return '';
        }

        $desc = [];
        /**
         * @var string $label
         * @var string[] $values
         */
        foreach ($data as $label => $values) {
            if (!$values) {
                continue;
            }
            $desc[$label] = '<attribute>' . ($label ?: '') . ': ' . implode(', ', $values) . '</attribute>';
        }

        return implode("\n", $desc);
    }
}