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
    /** Example: `myNameIsBond` */
    case Camel;

    /** Example: `MyNameIsBond` */
    case Pascal;

    /** Example: `my_name_is_bond` */
    case Snake;

    /** Example: `My_Name_Is_Bond` */
    case Ada;

    /** Example: `MY_NAME_IS_BOND` */
    case Macro;

    /** Example: `my-name-is-bond` */
    case Kebab;

    /** Example: `My-Name-Is-Bond` */
    case Train;

    /** Example: `MY-NAME-IS-BOND` */
    case Cobol;

    /** Example: `my name is bond` */
    case Lower;

    /** Example: `MY NAME IS BOND` */
    case Upper;

    /** Example: `My Name Is Bond` */
    case Title;

    /** Example: `My name is bond` */
    case Sentence;

    /** Example: `my.name.is.bond` */
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
