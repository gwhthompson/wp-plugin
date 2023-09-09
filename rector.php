<?php

declare(strict_types=1);

// use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
    ]);

    // // register a single rule
    // $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // // define sets of rules
    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::NAMING,
        SetList::PHP_80,
        SetList::PRIVATIZATION,
        SetList::TYPE_DECLARATION,
        LevelSetList::UP_TO_PHP_80,
    ]);

    $rectorConfig->autoloadPaths([
        // discover specific file
        __DIR__.'/vendor/php-stubs/wordpress-stubs/wordpress-stubs.php',
        // // or full directory
        // __DIR__.'/project-without-composer',
    ]);

    $rectorConfig->phpVersion(PhpVersion::PHP_80);
    $rectorConfig->phpstanConfig(__DIR__.'/phpstan.neon');
};
