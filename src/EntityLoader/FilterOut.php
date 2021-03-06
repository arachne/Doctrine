<?php

declare(strict_types=1);

namespace Arachne\Doctrine\EntityLoader;

use Arachne\Doctrine\Exception\InvalidArgumentException;
use Arachne\EntityLoader\FilterOutInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class FilterOut implements FilterOutInterface
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @var string[]
     */
    private $identifiers;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(string $type): bool
    {
        $manager = $this->managerRegistry->getManagerForClass($type);

        if ($manager === null) {
            return false;
        }

        $fields = $manager->getClassMetadata($type)->getIdentifierFieldNames();
        if (count($fields) !== 1 || !isset($fields[0])) {
            return false;
        }

        $this->identifiers[$type] = $fields[0];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function filterOut($value): string
    {
        $field = $this->identifiers[get_class($value)];
        $id = $value->{'get'.$field}();
        if ($id === null) {
            throw new InvalidArgumentException(sprintf('Missing value for identifier field "%s".', $field));
        }

        return (string) $id;
    }
}
