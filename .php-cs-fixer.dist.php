<?php

return (new PhpCsFixer\Config())
    ->setRules([
        'no_superfluous_phpdoc_tags' => false,
        'single_line_throw' => false,
        'phpdoc_trim_consecutive_blank_line_separation' => false,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => [ 'sort_algorithm' => 'length' ],
    ])
;
