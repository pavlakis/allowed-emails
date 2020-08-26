<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Pavlakis\Email\AllowedList\AllowedEmailList;

final class AllowedEmailListTest extends TestCase
{
    private AllowedEmailList $allowedList;

    protected function setUp(): void
    {
        $this->allowedList = new AllowedEmailList(['me@example.com', "o'neil@example.com"], ['example.com'], true);
    }

    /**
     * @test
     * @dataProvider emailListDataProvider
     *
     * @param string $email
     * @param bool   $allowed
     */
    public function is_email_allowed(string $email, bool $allowed): void
    {
        $this->assertSame($allowed, $this->allowedList->isEmailAllowed($email));
    }

    public function emailListDataProvider(): array
    {
        return [
            ['me@example.com', true],
            ["o'neil@example.com", true],
            ["me+alias@example.com", true],
            ["invalid", false],
        ];
    }

    /**
     * @test
     */
    public function it_does_not_allow_email_alias(): void
    {
        $allowedEmailList = new AllowedEmailList(['me@example.com'], ['example.com'], false);

        $this->assertFalse($allowedEmailList->isEmailAllowed('me+alias@example.com'));
    }

    /**
     * @test
     * @dataProvider domainListDataProvider
     *
     * @param string $email
     * @param bool   $allowed
     */
    public function is_domain_allowed(string $email, bool $allowed): void
    {
        $this->assertSame($allowed, $this->allowedList->isEmailDomainAllowed($email));
    }

    public function domainListDataProvider(): array
    {
        return [
            ['me@example.com', true],
            ['me@spam.com', false],
        ];
    }

    /**
     * @test
     */
    public function it_does_not_accept_invalid_emails_on_whitelist(): void
    {
        $this->expectException(\RuntimeException::class);
        new AllowedEmailList(['me@example'], ['example.com'], false);
    }

    /**
     * @test
     */
    public function it_does_not_validate_emails_on_whitelist_check(): void
    {
        $allowedEmailList = new AllowedEmailList(['me@example.com'], ['example.com'], true);

        $this->expectException(\LogicException::class);

        $allowedEmailList->isEmailAllowed('me+alias[at]example.com');
    }

    /**
     * @test
     */
    public function it_does_not_accept_invalid_email_domains(): void
    {
        $this->expectException(\RuntimeException::class);
        new AllowedEmailList(['me@example.com'], ['example'], false);
    }
}
