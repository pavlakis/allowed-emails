<?php

declare(strict_types=1);

namespace Pavlakis\Email\AllowedList;

class AllowedEmailList implements AllowedListInterface
{
    /**
     * @var array<int, string>
     */
    private array $emails;

    /**
     * @var array<int, string>
     */
    private array $emailDomains;

    /**
     * @param array<int, string> $emails
     * @param array<int, string> $emailDomains
     */
    public function __construct(array $emails, array $emailDomains)
    {
        $this->assertValidEmails($emails);
        $this->emails = $emails;

        $this->assertValidDomains($emailDomains);
        $this->emailDomains = $emailDomains;
    }

    /**
     * @param array<int, string> $emails
     */
    private function assertValidEmails(array $emails): void
    {
        foreach ($emails as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException(\sprintf('Email %s is not valid', $email));
            }
        }
    }

    /**
     * @param array<int, string> $domains
     */
    private function assertValidDomains(array $domains): void
    {
        foreach ($domains as $domain) {
            $email = 'me@' . $domain;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException(\sprintf('Domain %s is not valid', $domain));
            }
        }
    }

    public function isEmailAllowed(string $email): bool
    {
        if (false !== strpos($email, '+')) {
            $email = substr($email, 0, (int)strpos($email, '+'))
                .substr($email, (int) strpos($email, '@'));
        }

        return in_array($email, $this->emails, true);
    }

    public function isEmailDomainAllowed(string $email): bool
    {
        $emailDomain = substr($email, strpos($email, '@') + 1);

        return in_array($emailDomain, $this->emailDomains, true);
    }
}
