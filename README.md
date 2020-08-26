# pavlakis/allowed-emails

[![Build Status](https://travis-ci.org/pavlakis/allowed-emails.svg)](https://travis-ci.org/pavlakis/allowed-emails)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fpavlakis%2Fallowed-emails%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/pavlakis/allowed-emails/main)
[![codecov](https://codecov.io/gh/pavlakis/allowed-emails/branch/main/graph/badge.svg)](https://codecov.io/gh/pavlakis/allowed-emails)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

`pavlakis/allowed-emails` is a simple package to check allowed emails (aka whitelists) within
a predefined email list, and a list of email domains.

## Usage

Install the package by running:

``` bash
composer require pavlakis/allowed-emails
```

Can instantiate the `AllowedEmailList` class directly or use the following two named-constructors:
 
- `withAllowedAliases`
- `withoutAllowedAliases`

The parameters required are:
- An array of emails `array<int, string>`
These emails will be validated.

- An array of email domains `array<int, string>`
These email domains will be validated.

If not using the named-constructors, the `allowAlias` boolean flag is also a required parameter. Setting that to 
`true` will treat an email with an alias the same way as the email without the alias e.g. it will match `me+alias@example.com`
to `me@example.com`.
