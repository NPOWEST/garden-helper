<?php

// https://cs.symfony.com

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        /** Alias */

        // Replace non multibyte-safe functions with corresponding mb function. (risky)
        'mb_str_functions' => true,
        // Replace strpos() calls with str_starts_with() or str_contains() if possible. (risky)
        'modernize_strpos' => true,
        // Master functions shall be used instead of aliases. (risky)
        'no_alias_functions' => ['sets' => ['@internal', '@mbreg', '@mysqli', '@pg', '@time']],
        // Master language constructs shall be used instead of aliases.
        'no_alias_language_construct_call' => true,
        // Either language construct print or echo should be used.
        'no_mixed_echo_print' => true,
        // Cast shall be used, not settype. (risky)
        'set_type_to_cast' => true,

        /* Array Notation */
        // PHP arrays should be declared using the configured syntax.
        'array_syntax' => ['syntax' => 'short'],
        // Operator => should not be surrounded by multi-line whitespaces.
        'no_multiline_whitespace_around_double_arrow' => true,
        // In array declaration, there MUST NOT be a whitespace before each comma.
        'no_whitespace_before_comma_in_array' => true,
        // Array index should always be written by using square braces.
        'normalize_index_brace' => true,
        // If the function explicitly returns an array, and has the return type iterable, then yield from must be used instead of return.
        'return_to_yield_from' => true,
        // Arrays should be formatted like function/method arguments, without leading or trailing single line space.
        'trim_array_spaces' => true,
        // In array declaration, there MUST be a whitespace after each comma.
        // 'whitespace_after_comma_in_array' => ['ensure_single_space' => true],

        /** Attribute Notation */
        // PHP attributes declared without arguments must (not) be followed by empty parentheses.
        'attribute_empty_parentheses' => ['use_parentheses' => false],

        /** Basic */

        // Braces must be placed as configured.
        'braces_position' => [
            // Allow anonymous functions to have opening and closing braces on the same line.
            'allow_single_line_anonymous_functions' => true,
            // Allow anonymous classes to have opening and closing braces on the same line.
            'allow_single_line_empty_anonymous_classes' => true,
            // The position of the opening brace of anonymous classes‘ body.
            // Allowed values: 'next_line_unless_newline_at_signature_end' and 'same_line'
            'anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
            // The position of the opening brace of anonymous functions‘ body.
            // Allowed values: 'next_line_unless_newline_at_signature_end' and 'same_line'
            'anonymous_functions_opening_brace' => 'next_line_unless_newline_at_signature_end',
            // The position of the opening brace of classes‘ body.
            // Allowed values: 'next_line_unless_newline_at_signature_end' and 'same_line'
            'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
            // The position of the opening brace of control structures‘ body.
            // Allowed values: 'next_line_unless_newline_at_signature_end' and 'same_line'
            'control_structures_opening_brace' => 'next_line_unless_newline_at_signature_end',
            // The position of the opening brace of functions‘ body.
            // Allowed values: 'next_line_unless_newline_at_signature_end' and 'same_line'
            'functions_opening_brace' => 'next_line_unless_newline_at_signature_end',
        ],
        // PHP code MUST use only UTF-8 without BOM (remove BOM).
        'encoding' => true,
        // There must not be more than one statement per line.
        'no_multiple_statements_per_line' => true,
        // If a list of values separated by a comma is contained on a single line, then the last item MUST NOT have a trailing comma.
        'no_trailing_comma_in_singleline' => ['elements' => ['arguments', 'array', 'array_destructuring', 'group_import']],
        // Remove Zero-width space (ZWSP), Non-breaking space (NBSP) and other invisible unicode symbols. (risky)
        'non_printable_character' => ['use_escape_sequences_in_strings' => false],
        // Adds separators to numeric literals of any kind.
        'numeric_literal_separator' => ['strategy' => 'use_separator', 'override_existing' => true],
        // Literal octal must be in 0o notation.
        'octal_notation' => true,
        // Empty body of class, interface, trait, enum or function must be abbreviated as {} and placed on the same line as the previous symbol, separated by a single space.
        'single_line_empty_body' => true,

        /** Casing */

        // When referencing an internal class it must be written using the correct casing.
        'class_reference_name_casing' => true,
        // The PHP constants true, false, and null MUST be written using the correct casing.
        'constant_case' => ['case' => 'lower'],
        // Integer literals must be in correct case.
        'integer_literal_case' => true,
        // PHP keywords MUST be in lower case.
        'lowercase_keywords' => true,
        // Class static references self, static and parent MUST be in lower case.
        'lowercase_static_reference' => true,
        // Magic constants should be referred to using the correct casing.
        'magic_constant_casing' => true,
        // Magic method definitions and calls must be using the correct casing.
        'magic_method_casing' => true,
        // Function defined by PHP should be called using the correct casing.
        'native_function_casing' => true,
        // Native type hints for functions should use the correct case.
        'native_function_type_declaration_casing' => true,

        /** Cast Notation */

        // A single space or none should be between cast and variable.
        'cast_spaces' => ['space' => 'single'],
        // Cast should be written in lower case.
        'lowercase_cast' => true,
        // Replaces intval, floatval, doubleval, strval and boolval function calls with according type casting operator. (risky)
        'modernize_types_casting' => true,
        // Short cast bool using double exclamation mark should not be used.
        'no_short_bool_cast' => true,
        // Variables must be set null instead of using (unset) casting.
        'no_unset_cast' => true,
        // Cast (boolean) and (integer) should be written as (bool) and (int), (double) and (real) as (float), (binary) as (string).
        'short_scalar_cast' => true,

        /** Class Notation */

        // Class, trait and interface elements must be separated with one or none blank line.
        'class_attributes_separation' => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'one', 'case' => 'one']],
        // Whitespace around the keywords of a class, trait, enum or interfaces definition should be one space.
        'class_definition' => [
            // Whether constructor argument list in anonymous classes should be single line.
            'inline_constructor_arguments' => true,
            // Whether definitions should be multiline.
            'multi_line_extends_each_single_line' => false,
            // Whether definitions should be single line when including a single item.
            'single_item_single_line' => true,
            // Whether definitions should be single line.
            'single_line' => true,
            // Whether there should be a single space after the parenthesis of anonymous class (PSR12) or not.
            'space_before_parenthesis' => true,
        ],
        // All classes must be final, except abstract ones and Doctrine entities. (risky)
        'final_class' => true,
        // Internal classes should be final. (risky)
        'final_internal_class' => true,
        // All public methods of abstract classes should be final. (risky)
        'final_public_method_for_abstract_class' => true,
        // There should be no empty lines after class opening brace.
        'no_blank_lines_after_class_opening' => true,
        // Properties MUST not be explicitly initialized with null except when they have a type declaration (PHP 7.4).
        'no_null_property_initialization' => true,
        // Convert PHP4-style constructors to __construct. (risky)
        'no_php4_constructor' => true,
        // Removes final from methods where possible. (risky)
        'no_unneeded_final_method' => ['private_methods' => false],
        // Orders the elements of classes/interfaces/traits/enums.
        'ordered_class_elements' => ['order' => ['use_trait']],
        // Orders the interfaces in an implements or interface extends clause.
        'ordered_interfaces' => true,
        // Sort union types and intersection types using configured order.
        'ordered_types' => ['sort_algorithm' => 'alpha', 'null_adjustment' => 'always_last'],
        // Converts protected variables and methods to private where possible.
        'protected_to_private' => true,
        // Inside class or interface element self should be preferred to the class name itself. (risky)
        'self_accessor' => true,
        // Inside an enum or final/anonymous class, self should be preferred over static.
        'self_static_accessor' => true,
        // There MUST NOT be more than one property or constant declared per statement.
        'single_class_element_per_statement' => ['elements' => ['const', 'property']],
        // Each trait use must be done as single statement.
        'single_trait_insert_per_statement' => true,
        // Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.
        'visibility_required' => ['elements' => ['method', 'property']],

        /** Comment */

        // Comments with annotation should be docblock when used on structural elements. (risky)
        'comment_to_phpdoc' => ['ignored_tags' => []],
        // DocBlocks must start with two asterisks, multiline comments must start with a single asterisk, after the opening slash. Both must end with a single asterisk before the closing slash.
        'multiline_comment_opening_closing' => true,
        // There should not be any empty comments.
        'no_empty_comment' => true,
        // There MUST be no trailing spaces inside comment or PHPDoc.
        'no_trailing_whitespace_in_comment' => true,
        // Single-line comments must have proper spacing.
        // 'single_line_comment_spacing' => true,
        // Single-line comments and multi-line comments with only one line of actual content should use the // syntax.
        'single_line_comment_style' => ['comment_types' => ['hash']],

        /** Control Structure */

        // The body of each control structure MUST be enclosed within braces.
        'control_structure_braces' => true,
        // Control structure continuation keyword must be on the configured line.
        'control_structure_continuation_position' => ['position' => 'next_line'],
        // Empty loop-body must be in configured style.
        'empty_loop_body' => ['style' => 'braces'],
        // Empty loop-condition must be in configured style.
        'empty_loop_condition' => ['style' => 'while'],
        // Include/Require and file path should be divided with a single space. File path should not be placed within parentheses.
        'include' => true,
        // Replace control structure alternative syntax to use braces.
        'no_alternative_syntax' => true,
        // There must be a comment when fall-through is intentional in a non-empty case body.
        'no_break_comment' => true,
        // Removes unneeded braces that are superfluous and aren’t part of a control structure’s body.
        'no_unneeded_braces' => ['namespaces' => true],
        // Removes unneeded parentheses around control statements.
        'no_unneeded_control_parentheses' => ['statements' => ['break', 'clone', 'continue', 'echo_print', 'others', 'return', 'switch_case', 'yield', 'yield_from']],
        // There should not be useless else cases.
        'no_useless_else' => true,
        // Simplify if control structures that return the boolean result of their condition.
        'simplified_if_return' => true,
        // A case should be followed by a colon and not a semicolon.
        'switch_case_semicolon_to_colon' => true,
        // Removes extra spaces between colon and case value.
        'switch_case_space' => true,
        // Switch case must not be ended with continue but with break.
        'switch_continue_to_break' => true,
        // Write conditions in Yoda style (true), non-Yoda style (['equal' => false, 'identical' => false, 'less_and_greater' => false]) or ignore those conditions (null) based on configuration.
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],

        /** Doctrine Annotation */

        // Doctrine annotations must use configured operator for assignment in arrays.
        'doctrine_annotation_array_assignment' => ['operator' => ':'],
        // Doctrine annotations without arguments must use the configured syntax.
        'doctrine_annotation_braces' => true,
        // Doctrine annotations must be indented with four spaces.
        'doctrine_annotation_indentation' => true,
        // Fixes spaces in Doctrine annotations.
        'doctrine_annotation_spaces' => true,

        /** Function Notation */

        // Replace multiple nested calls of dirname by only one call with second $level parameter. Requires PHP >= 7.0. (risky)
        'combine_nested_dirname' => true,
        // The first argument of DateTime::createFromFormat method must start with !. (risky)
        'date_time_create_from_format_call' => true,
        // Order the flags in fopen calls, b and t must be last. (risky)
        'fopen_flag_order' => true,
        // The flags in fopen calls must omit t, and b must be omitted or included consistently. (risky)
        'fopen_flags' => ['b_mode' => false],
        // Spaces should be properly placed in a function declaration.
        'function_declaration' => true,
        // Function implode must be called with 2 arguments in the documented order. (risky)
        'implode_call' => true,
        // Lambda must not import variables it doesn’t use.
        'lambda_not_used_import' => true,
        // In method arguments and method call, there MUST NOT be a space before each comma and there MUST be one space after each comma. Argument lists MAY be split across multiple lines, where each subsequent line is indented once. When doing so, the first item in the list MUST be on the next line, and there MUST be only one argument per line.
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline', 'keep_multiple_spaces_after_comma' => false],
        // Add leading \ before function invocation to speed up resolving.  (risky)
        'native_function_invocation' => ['include' => ['@compiler_optimized'], 'scope' => 'namespaced', 'strict' => true],
        // When making a method or function call, there MUST NOT be a space between the method or function name and the opening parenthesis.
        'no_spaces_after_function_name' => true,
        // In function arguments there must not be arguments with default values before non-default ones. (risky)
        'no_unreachable_default_argument_value' => true,
        // There must be no sprintf calls with only the first argument. (risky)
        'no_useless_sprintf' => true,
        // Adds or removes ? before single type declarations or |null at the end of union types when parameters have a default null value.
        'nullable_type_declaration_for_default_null_value' => true,
        // Takes @param annotations of non-mixed types and adjusts accordingly the function signature. Requires PHP >= 7.0. (experimental, risky
        'phpdoc_to_param_type' => true,
        // Takes @var annotation of non-mixed types and adjusts accordingly the property signature. Requires PHP >= 7.4. (experimental, risky)
        'phpdoc_to_property_type' => true,
        // Takes @return annotation of non-mixed types and adjusts accordingly the function signature. (experimental, risky)
        'phpdoc_to_return_type' => true,
        // Callables must be called without using call_user_func* when possible. (risky)
        'regular_callable_call' => true,
        // Adjust spacing around colon in return type declarations and backed enum types.
        'return_type_declaration' => ['space_before' => 'one'],
        // Throwing exception must be done in single line.
        'single_line_throw' => true,
        // Lambdas not (indirectly) referencing $this must be declared static. (risky)
        'static_lambda' => true,
        // Anonymous functions with one-liner return statement must use arrow functions. (risky)
        'use_arrow_functions' => true,
        // Add void return type to functions with missing or empty return statements, but priority is given to @return annotations. Requires PHP >= 7.1. (risky)
        'void_return' => true,

        /** Import */

        // Removes the leading part of fully qualified symbol references if a given symbol is imported or belongs to the current namespace.
        'fully_qualified_strict_types' => ['import_symbols' => true],
        // Imports or fully qualifies global classes/functions/constants.
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => false],
        // There MUST be group use for the same namespaces.
        'group_import' => true,
        // Remove leading slashes in use clauses.
        'no_leading_import_slash' => true,
        // Imports should not be aliased as the same name.
        'no_unneeded_import_alias' => true,
        // Unused use statements must be removed.
        'no_unused_imports' => true,
        // Ordering use statements.
        'ordered_imports' => ['sort_algorithm' => 'alpha', 'imports_order' => ['const', 'class', 'function']],
        // There MUST be one use keyword per declaration.
        // 'single_import_per_statement' => ['group_to_single_imports' => false],
        // Each namespace use MUST go on its own line and there MUST be one blank line after the use statements block.
        'single_line_after_imports' => true,

        /** Language Construct */

        // Converts FQCN strings to *::class keywords. (experimental, risky)
        'class_keyword' => true,
        // Using isset($var) && multiple times should be done in one call.
        'combine_consecutive_issets' => true,
        // Calling unset on multiple items should be done in one call.
        'combine_consecutive_unsets' => true,
        // Equal sign in declare statement should be surrounded by spaces or not following configuration.
        'declare_equal_normalize' => ['space' => 'single'],
        // There must not be spaces around declare statement parentheses.
        'declare_parentheses' => true,
        // Replaces dirname(__FILE__) expression with equivalent __DIR__ constant. (risky)
        'dir_constant' => true,
        // Error control operator should be added to deprecation notices and/or removed from other cases. (risky)
        'error_suppression' => true,
        // Add curly braces to indirect variables to make them clear to understand. Requires PHP >= 7.0.
        'explicit_indirect_variable' => true,
        // Replace core functions calls returning constants with the constants. (risky)
        'function_to_constant' => true,
        // Replace get_class calls on object variables with class keyword syntax. (risky)
        'get_class_to_class_keyword' => true,
        // Replaces is_null($var) expression with null === $var. (risky)
        'is_null' => true,
        // Properties should be set to null instead of using unset. (risky)
        'no_unset_on_property' => true,
        // Nullable single type declaration should be standardised using configured syntax.
        'nullable_type_declaration' => true,
        // Ensures a single space after language constructs.
        'single_space_around_construct' => true,

        /** List Notation */

        // List (array destructuring) assignment should be declared using the configured syntax. Requires PHP >= 7.1.
        'list_syntax' => true,

        /** Namespace Notation */

        // There MUST be one blank line after the namespace declaration.
        'blank_line_after_namespace' => true,
        // Controls blank lines before a namespace declaration.
        'blank_lines_before_namespace' => ['max_line_breaks' => 2],
        // Namespace must not contain spacing, comments or PHPDoc.
        'clean_namespace' => true,
        // The namespace declaration line shouldn’t contain leading whitespace.
        'no_leading_namespace_whitespace' => true,

        /** Operator */

        // Use the null coalescing assignment operator ??= where possible.
        'assign_null_coalescing_to_coalesce_equal' => true,
        // Binary operators should be surrounded by space as configured.
        'binary_operator_spaces' => [
            'default'   => 'align_single_space_minimal',
            'operators' => ['??' => null, '*' => null, '/' => null, '+' => 'single_space', '-' => 'single_space', '=>' => 'align_single_space_minimal_by_scope']
        ],
        // Concatenation should be spaced according to configuration.
        'concat_space' => ['spacing' => 'none'],
        // Use && and || logical operators instead of and and or. (risky)
        'logical_operators' => true,
        // Shorthand notation for operators should be used if possible. (risky)
        'long_to_shorthand_operator' => true,
        // All instances created with new keyword must (not) be followed by parentheses.
        'new_with_parentheses' => true,
        // There must be no space around double colons (also called Scope Resolution Operator or Paamayim Nekudotayim).
        'no_space_around_double_colon' => true,
        // There should not be useless concat operations.
        'no_useless_concat_operator' => ['juggle_simple_strings' => true],
        // There should not be useless Null-safe operator ?-> used.
        'no_useless_nullsafe_operator' => true,
        // Logical NOT operators (!) should have one trailing whitespace.
        'not_operator_with_successor_space' => true,
        // There should not be space before or after object operators -> and ?->.
        'object_operator_without_whitespace' => true,
        // Operators - when multiline - must always be at the beginning or at the end of the line.
        'operator_linebreak' => true,
        // Increment and decrement operators should be used if possible.
        'standardize_increment' => true,
        // Replace all <> with !=.
        'standardize_not_equals' => true,
        // Standardize spaces around ternary operator.
        'ternary_operator_spaces' => true,
        // Use the Elvis operator ?: where possible. (risky)
        'ternary_to_elvis_operator' => true,
        // Use null coalescing operator ?? where possible. Requires PHP >= 7.0.
        'ternary_to_null_coalescing' => true,
        // Unary operators should be placed adjacent to their operands.
        'unary_operator_spaces' => true,

        /** PHP Tag */

        // Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
        'blank_line_after_opening_tag' => true,
        // Replaces short-echo <?= with long format <?php echo/<?php print syntax, or vice-versa.
        'echo_tag_syntax' => true,
        // PHP code must use the long <?php tags or short-echo <?= tags and not other tag variations.
        'full_opening_tag' => true,
        // Ensure there is no code on the same line as the PHP open tag.
        'linebreak_after_opening_tag' => true,
        // The closing \?\> tag MUST be omitted from files containing only PHP.
        'no_closing_tag' => true,

        /** PHPDoc */

        // Each line of multi-line DocComments must have an asterisk [PSR-5] and must be aligned with the first one.
        'align_multiline_comment' => ['comment_type' => 'phpdocs_like'],
        // Renames PHPDoc tags.
        'general_phpdoc_tag_rename' => ['replacements' => ['inheritDocs' => 'inheritDoc', 'inherit' => 'inheritDoc', 'inhebit' => 'inheritDoc']],
        // There should not be blank lines between docblock and the documented element.
        'no_blank_lines_after_phpdoc' => true,
        // There should not be empty PHPDoc blocks.
        'no_empty_phpdoc' => true,
        // Removes @param, @return and @var tags that don’t provide any useful information.
        'no_superfluous_phpdoc_tags' => ['allow_hidden_params' => true, 'remove_inheritdoc' => true],
        // PHPDoc should contain @param for all params.
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
        // All items of the given phpdoc tags must be either left-aligned or (by default) aligned vertically.
        'phpdoc_align' => ['align' => 'vertical'],
        // PHPDoc annotation descriptions should not be a sentence.
        'phpdoc_annotation_without_dot' => true,
        // Docblocks should have the same indentation as the documented subject.
        'phpdoc_indent' => true,
        // Fixes PHPDoc inline tags.
        'phpdoc_inline_tag_normalizer' => true,
        // Changes doc blocks from single to multi line, or reversed. Works for class constants, properties and methods only.
        'phpdoc_line_span' => ['const' => 'single', 'method' => 'multi', 'property' => 'single'],
        // @access annotations should be omitted from PHPDoc.
        'phpdoc_no_access' => true,
        // @return void and @return null annotations should be omitted from PHPDoc.
        'phpdoc_no_empty_return' => true,
        // Annotations in PHPDoc should be ordered in defined sequence.
        'phpdoc_order' => ['order' => ['package', 'link', 'license', 'copyright', 'param', 'throws', 'return']],
        // Orders all @param annotations in DocBlocks according to method signature.
        'phpdoc_param_order' => true,
        // The type of @return annotations of methods returning a reference to itself must the configured one.
        'phpdoc_return_self_reference' => true,
        // Scalar types should always be written in the same form. int not integer, bool not boolean, float not real or double.
        'phpdoc_scalar' => true,
        // Annotations in PHPDoc should be grouped together so that annotations of the same type immediately follow each other. Annotations of a different type are separated by a single blank line.
        'phpdoc_separation' => ['groups' => [['link', 'copyright', 'license'], ['param'], ['return']], 'skip_unlisted_annotations' => true],
        // Single line @var PHPDoc should have proper spacing.
        'phpdoc_single_line_var_spacing' => true,
        // Forces PHPDoc tags to be either regular annotations or inline.
        'phpdoc_tag_type' => ['tags' => ['inheritDoc' => 'inline']],
        // Docblocks should only be used on structural elements.
        'phpdoc_to_comment' => ['ignored_tags' => ['todo', 'var', 'psalm-suppress', 'SuppressWarnings']],
        // Removes extra blank lines after summary and after description in PHPDoc.
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        // PHPDoc should start and end with content, excluding the very first and last line of the docblocks.
        'phpdoc_trim' => true,
        // The correct case must be used for standard PHP types in PHPDoc.
        'phpdoc_types' => true,
        // Sorts PHPDoc types.
        'phpdoc_types_order' => ['sort_algorithm' => 'alpha', 'null_adjustment' => 'always_last'],
        // @var and @type annotations must have type and name in the correct order.
        'phpdoc_var_annotation_correct_order' => true,

        /** Return Notation */

        // There should not be an empty return statement at the end of a function.
        'no_useless_return' => true,
        // Local, dynamic and directly referenced variables should not be assigned and directly returned by a function or method.
        'return_assignment' => true,
        // A return statement wishing to return void should not return null.
        'simplified_null_return' => true,

        /** Semicolon */

        // Forbid multi-line whitespace before the closing semicolon or move the semicolon to the new line for chained calls.
        'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
        // Remove useless (semicolon) statements.
        'no_empty_statement' => true,
        // Single-line whitespace before closing semicolon are prohibited.
        'no_singleline_whitespace_before_semicolons' => true,
        // Instructions must be terminated with a semicolon.
        'semicolon_after_instruction' => true,
        // Fix whitespace after a semicolon.
        'space_after_semicolon' => ['remove_in_empty_for_expressions' => true],

        /** Strict */
        //
        // Force strict types declaration in all files. Requires PHP >= 7.0.
        // 'declare_strict_types' => true,

        /** String Notation */

        // Converts implicit variables into explicit ones in double-quoted strings or heredoc syntax.
        'explicit_string_variable' => true,
        // Converts explicit variables in double-quoted strings and heredoc syntax from simple to complex format (${ to {$).
        'simple_to_complex_string_variable' => true,
        // Convert double quotes to single quotes for simple strings.
        'single_quote' => ['strings_containing_single_quote_chars' => false],

        /** Whitespace */

        // Each element of an array must be indented exactly once.
        'array_indentation' => true,
        // An empty line feed must precede any configured statement.
        'blank_line_before_statement' => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try', 'case']],
        // Putting blank lines between use statement groups.
        'blank_line_between_import_groups' => true,
        // Remove extra spaces in a nullable type declaration.
        'compact_nullable_type_declaration' => true,
        // Code MUST use configured indentation type.
        'indentation_type' => true,
        // All PHP files must use same line ending.
        'line_ending' => true,
        // Method chaining MUST be properly indented. Method chaining with different levels of indentation is not supported.
        'method_chaining_indentation' => true,
        // Removes extra blank lines and/or blank lines following configuration.
        'no_extra_blank_lines' => ['tokens' => ['attribute', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'square_brace_block', 'switch', 'throw', 'use']],
        'no_spaces_around_offset' => true,
        // Remove trailing whitespace at the end of non-blank lines.
        'no_trailing_whitespace' => true,
        // Remove trailing whitespace at the end of blank lines.
        'no_whitespace_in_blank_line' => true,
        // Parentheses must be declared using the configured whitespace.
        'spaces_inside_parentheses' => true,
        // Each statement must be indented.
        'statement_indentation' => ['stick_comment_to_next_continuous_control_statement' => true],
        // Ensure single space between a variable and its type declaration in function arguments and properties.
        'type_declaration_spaces' => ['elements' => ['function', 'property']],
        // A single space or none should be around union type and intersection type operators.
        'types_spaces' => true,

        // // 'braces' => [
        // //     'position_after_anonymous_constructs'         => 'next',
        // //     'position_after_control_structures'           => 'next',
        // //     'position_after_functions_and_oop_constructs' => 'next'
        // // ],
    ])->setIndent("\t");
