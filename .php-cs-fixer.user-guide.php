<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;
use Nexus\CsConfig\Fixer\Comment\NoCodeSeparatorCommentFixer;
use Nexus\CsConfig\FixerGenerator;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->files()
    ->in([
        __DIR__ . '/user_guide_src/source',
    ])
    ->notPath([
        'ci3sample/',
        'libraries/sessions/016.php',
        'database/query_builder/075.php',
    ]);

$overrides = [
    'echo_tag_syntax'             => false,
    'php_unit_internal_class'     => false,
    'no_unused_imports'           => false,
    'class_attributes_separation' => false,
    // <<<<<<<<<<<<<<<<<<<<<<<< @TODO TO BE REMOVED ONCE LIVE IN CODING-STANDARD
    'blank_line_between_import_groups' => true,
    'class_definition'                 => [
        'multi_line_extends_each_single_line' => true,
        'single_item_single_line'             => true,
        'single_line'                         => true,
        'space_before_parenthesis'            => true,
        'inline_constructor_arguments'        => true,
    ],
    'control_structure_braces'        => true,
    'no_multiple_statements_per_line' => true,
    'no_trailing_comma_in_singleline' => [
        'elements' => [
            'arguments',
            'array_destructuring',
            'array',
            'group_import',
        ],
    ],
    'no_useless_nullsafe_operator' => true,
    'phpdoc_separation'            => [
        'groups' => [
            ['immutable', 'psalm-immutable'],
            ['param', 'phpstan-param', 'psalm-param'],
            ['phpstan-pure', 'psalm-pure'],
            ['readonly', 'psalm-readonly'],
            ['return', 'phpstan-return', 'psalm-return'],
            ['template', 'phpstan-template', 'psalm-template'],
            ['template-covariant', 'phpstan-template-covariant', 'psalm-template-covariant'],
            ['phpstan-type', 'psalm-type'],
            ['var', 'phpstan-var', 'psalm-var'],
        ],
    ],
    'single_line_comment_spacing' => true,
    'statement_indentation'       => true,
    // >>>>>>>>>>>>>>>>>>>>>>>>>
];

$options = [
    'cacheFile'    => 'build/.php-cs-fixer.user-guide.cache',
    'finder'       => $finder,
    'customFixers' => FixerGenerator::create('vendor/nexusphp/cs-config/src/Fixer', 'Nexus\\CsConfig\\Fixer'),
    'customRules'  => [
        NoCodeSeparatorCommentFixer::name() => true,
    ],
];

return Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();
