<?php
/**
 * @author Morten Harders <mmh@harders-it.dk>
 */

namespace ExeQue\Mutators\Data;

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
}
