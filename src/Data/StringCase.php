<?php
/**
 * @author Morten Harders <mmh@harders-it.dk>
 */

namespace ExeQue\Remix\Data;

use ExeQue\Remix\Exceptions\InvalidArgumentException;

/**
 * @see https://github.com/jawira/case-converter
 */
enum StringCase
{
    /**
     * camelCase - Example: camelCase, firstName, lastName etc.
     */
    case Camel;

    /**
     * PascalCase - Example: PascalCase, FirstName, LastName etc.
     */
    case Pascal;

    /**
     * snake_case - Example: snake_case, first_name, last_name etc.
     */
    case Snake;

    /**
     * Ada_Case - Example: Ada_Case, First_Name, Last_Name etc.
     */
    case Ada;

    /**
     * MACRO_CASE - Example: MACRO_CASE, FIRST_NAME, LAST_NAME etc.
     */
    case Macro;

    /**
     * kebab-case - Example: kebab-case, first-name, last-name etc.
     */
    case Kebab;

    /**
     * Train-Case - Example: Train-Case, First-Name, Last-Name etc.
     */
    case Train;

    /**
     * COBOL-CASE - Example: COBOL-CASE, FIRST-NAME, LAST-NAME etc.
     */
    case Cobol;

    /**
     * lower case - Example: lower case, first name, last name etc.
     *
     * Note: This is _not_ the same as `toUpper` from `jawira/case-converter`!
     */
    case Lower;

    /**
     * UPPER CASE - Example: UPPER CASE, FIRST NAME, LAST NAME etc.
     *
     * Note: This is _not_ the same as `toUpper` from `jawira/case-converter`!
     */
    case Upper;

    /**
     * Title Case - Example: Title Case, First Name, Last Name etc.
     */
    case Title;

    /**
     * Sentence case - Example: Sentence case, First name, Last name etc.
     */
    case Sentence;

    /**
     * dot.case - Example: dot.case, first.name, last.name etc.
     */
    case Dot;

    public static function from(self|string $case): StringCase
    {
        if ($case instanceof self) {
            return $case;
        }

        return match (mb_strtolower($case)) {
            'camel'    => self::Camel,
            'pascal'   => self::Pascal,
            'snake'    => self::Snake,
            'ada'      => self::Ada,
            'macro'    => self::Macro,
            'kebab'    => self::Kebab,
            'train'    => self::Train,
            'cobol'    => self::Cobol,
            'lower'    => self::Lower,
            'upper'    => self::Upper,
            'title'    => self::Title,
            'sentence' => self::Sentence,
            'dot'      => self::Dot,
            default    => throw new InvalidArgumentException("Unknown string case: {$case}"),
        };
    }
}
