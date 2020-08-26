<?php

namespace Pavlakis\Email\AllowedList;

interface AllowedListInterface
{
    public function isEmailAllowed(string $email): bool;

    public function isEmailDomainAllowed(string $email): bool;
}
