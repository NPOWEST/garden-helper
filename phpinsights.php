<?php

declare(strict_types = 1);

use NunoMaduro\PhpInsights\Domain\Insights\{CyclomaticComplexityIsHigh, ForbiddenTraits};
use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\DisallowTabIndentSniff;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Import\SingleImportPerStatementFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousTraitNamingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\{DocCommentSpacingSniff, InlineDocCommentDeclarationSniff};
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowEmptySniff;
use SlevomatCodingStandard\Sniffs\Functions\FunctionLengthSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\{UseFromSameNamespaceSniff, UseSpacingSniff};
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\{DeclareStrictTypesSniff, DisallowMixedTypeHintSniff};

return [
	'preset'       => 'symfony',
	'ide'          => null,

	'exclude'      => [
		'var',
		'translations',
		'config',
		'public',
		'phpinsights.php',
	],

	'add'          => [
		//  ExampleMetric::class => [
		//      ExampleInsight::class,
		//  ]
	],

	'remove'       => [
		ForbiddenSetterSniff::class,
		DisallowEmptySniff::class,
		DeclareStrictTypesSniff::class,
		InlineDocCommentDeclarationSniff::class,
		DisallowMixedTypeHintSniff::class,
		UseFromSameNamespaceSniff::class,
		ForbiddenTraits::class,
		SuperfluousTraitNamingSniff::class,
		LineLengthSniff::class,
		DisallowTabIndentSniff::class,
		UseSpacingSniff::class,
		DocCommentSpacingSniff::class,
		BracesFixer::class,
		SingleImportPerStatementFixer::class,
	],

	'config'       => [
		DeclareEqualNormalizeFixer::class => [
			'space' => 'single',
		],
		FunctionLengthSniff::class        => [
			'maxLinesLength' => 100,
		],
		CyclomaticComplexityIsHigh::class => [
			'maxComplexity' => 25,
		],
		ReturnTypeHintSpacingSniff::class => [
			'spacesCountBeforeColon' => 1,
		],
		BinaryOperatorSpacesFixer::class  => [
			// default fix strategy: possibles values ['align', 'align_single_space', 'align_single_space_minimal', 'single_space', 'no_space', null]
			'default' => 'align_single_space_minimal',
		],
		OrderedClassElementsFixer::class  => [
			// List of strings defining order of elements.
			'order'          => [
				'use_trait',
				'constant_public',
				'constant_protected',
				'constant_private',
				// 'property_public',
				// 'property_protected',
				// 'property_private',
				// 'construct',
				// 'destruct',
				// 'magic',
				// 'phpunit',
				// 'method_public',
				// 'method_protected',
				// 'method_private',
			],
			// possible values ['none', 'alpha']
			'sort_algorithm' => 'none'
		]
	],

	/*
	|--------------------------------------------------------------------------
	| Requirements
	|--------------------------------------------------------------------------
	|
	| Here you may define a level you want to reach per `Insights` category.
	| When a score is lower than the minimum level defined, then an error
	| code will be returned. This is optional and individually defined.
	|
	*/

	'requirements' => [
		'min-quality'            => 100,
		'min-complexity'         => 0,
		'min-architecture'       => 100,
		'min-style'              => 100,
		'disable-security-check' => false,
	],
	'threads'      => null,
	'timeout'      => 60,
];
