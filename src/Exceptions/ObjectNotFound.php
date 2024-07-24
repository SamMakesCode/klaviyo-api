<?php

namespace SamMakesCode\KlaviyoApi\Exceptions;

class ObjectNotFound extends \Exception
{
    public function __construct(string $type, string $id, \Throwable $previous)
    {
        $template = 'No object with ID "%s" in "%s" found.';

        parent::__construct(
            sprintf(
                $template,
                $id,
                $type,
            ),
            0,
            $previous
        );
    }
}
