<?php

namespace App\Domain\Exception;

class ValidationException extends \Exception
{
    protected array $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;

        $message = sprintf("Validation failed :\n%s\n", implode(", ", $this->errors));

        parent::__construct($message);
    }
}
