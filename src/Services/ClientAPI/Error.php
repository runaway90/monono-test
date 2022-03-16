<?php

namespace App\Services\ClientAPI;

class Error
{
    const ERR_AUTH = 'Value is not number';
    const ERR_FORM_EMPTY = '';
    /** @var string */
    private $message;

    /** @var string|null */
    private $property;

    public function __construct(string $message, ?string $property = null)
    {
        $this->message = $message;
        $this->property = $property;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function property(): ?string
    {
        return $this->property;
    }

}
