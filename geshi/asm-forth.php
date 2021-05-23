<?php
/*************************************************************************************
 * Complete GeSHi librarie for ASM AVR FORTH language
 ************************************************************************************/

/*
  d- d+ dabs ?dnegate dnegate
s>d rdrop in, inline
zfl pfl xa> >xa x>r .s r0 s0 latest state bl [']
-@  ] [ [char] ihere ( char ' lit abort"
 prompt quit inlined shb
'source >in tiu tib ti# number? ud/mod ud* sign? digit? find (f)
@+ place word parse /string source pad hp task
ulink rsave . u.r u. sign digit up /
u* slash mod ( perturbe....)
u/ * u/mod um/mod um*   > < = 0< 0= <> +! 2/ 2* >body  negate invert xor or
and - m+ + abs r@ r> >r ," accept cf, chars char+ cells cell+ aligned align
cell dp >< rp@ sp@ @ex skip n=
 iflush cwd wd- wd+ pause is  fl+ fl-  di ei ver
 */


$language_data = array (
    'LANG_NAME' => 'ASM-FORTH',
    'COMMENT_SINGLE' => array(
        1 => '\\',
    ),
//    'COMMENT_MULTI' => array(),
    'COMMENT_MULTI' => array( '( ' => ')'),
    'NUMBERS' =>
        GESHI_NUMBER_INT_BASIC | GESHI_NUMBER_OCT_PREFIX | GESHI_NUMBER_HEX_PREFIX | GESHI_NUMBER_FLT_SCI_ZERO,
    'COMMENT_REGEXP' => array(
        1 => '(\((.*?)\))',
//        2 => "/^\s*::.*$/m",
//        3 => '/(?<![a-z])\'.*?\'/i',
        // ASCII-85 Strings
//        4 => "/<~.*~>/si",
        ),    //FORTH comment lines
//    'SCRIPT_DELIMITERS' => array(
//        1 => array(
//            ' ' => ' '
//            ),
//    ),
//    'HIGHLIGHT_STRICT_BLOCK' => array(
//        1 => false,
//        2 => true
//        ),
    'CASE_KEYWORDS' => GESHI_CAPS_NO_CHANGE,
    'QUOTEMARKS' => array(),
    'ESCAPE_CHAR' => '',
    'ESCAPE_REGEXP' => array(
        //Hexadecimal Char Specs
        0 => "[$][0-9a-fA-F]+",
        1 => "[%][01]+",
        2 => "[#][0-9]+",
        ),
    'KEYWORDS' => array(
        /* Flow control keywords */
        1 => array(
            ':', '<semi>', '[', ']', 'code', 'end-code',

            // **** XASSEMBLER *************************************************
            'adc,', 'add,',  'adiw,',   'and,',  'andi,',  'asr,',
            'bclr,', 'bset,',
            'call,', 'com,',
            'cbi,', 'cbr,', 'clc,', 'clh,', 'cli,', 'cln,', 'clr,', 'cls,', 'clt,', 'clv,', 'clz,',
            'cp,', 'cpc,', 'cpi,', 'cpse,',
            'dec,',
            'eicall,', 'eijmp,', 'eor,',
            'fmul,', 'fmuls,', 'fmulsu,',
            'icall,', 'ijmp,', 'inc,',
            'ld,', 'ldd,', 'ldi,', 'lds,',  'lsl,',  'lsr,',
            'mul,', 'muls,', 'mulsu,',
            'neg,', 'nop,',
            'or,',  'ori,',
            'pop,', 'push,',
            'ret,', 'rcall,', 'rjmp,', 'reti,', 'rol,', 'ror,',
            'sbiw,', 'sleep,', 'st,',

            'r0', 'r1', 'r2', 'r3', 'r4',  'r5', 'r6', 'r7', 'r8', 'r9',
            'r10', 'r11', 'r12', 'r13', 'r14',  'r15', 'r16', 'r17', 'r18', 'r19',
            'r20', 'r21', 'r22', 'r23', 'r24',  'r25', 'r26', 'r27', 'r28', 'r29',
            'r30', 'r31',            


            ),
        /* IF statement keywords */
        2 => array(
            'if,', 'else,', 'then,',
            'begin,', 'again,',  'until,',
            'cs,',            'eq,',            'hs,',            'ie,',
            'lo,',            'lt,',            'mi,',            'ts,',
            'vs,',            'not,',
            '[if]', '[ifdef]', '[ifundef]', '[else]', '[endif]', '[then]',
            ),
        /* Internal commands */
        3 => array(
            '.byte',  '.db',  '.def',  '.dw',  '.equ', '.set',
            '.macro',  '.endmacro',

            ),
        /* constantes et variables */
        4 => array(
            '&lt;&lt;',   '&gt;&gt;',   '||',   '&amp;&amp;',
            ),
//        ),
        /*Operands*/
//        5 => array(
//        )
        ),
    'SYMBOLS' => array(),
    'CASE_SENSITIVE' => array(
        GESHI_COMMENTS => false,
        1 => false,
        2 => false,
        3 => false,
        4 => false,
//        5 => false,
        ),
    'STYLES' => array(
        'KEYWORDS' => array(
            1 => 'color: #0099aa;',
            2 => 'color: #0000ff; background-color: white; font-weight: bold;',
            3 => 'color: #ff7777; font-weight: bold;',
            4 => 'color: #ff77ff; font-weight: bold;',
            5 => 'color: #0099aa;'
            ),
        'COMMENTS' => array(
            1 => 'color: #808080; font-style: italic;',
            2 => 'color: #b100b1; font-style: italic;',
            3 => 'color: #b100b1; font-style: italic;',
            4 => 'color: #33cc33; font-style: italic;'
            ),
        'ESCAPE_CHAR' => array(
            0 => 'color: #ff0000; font-weight: bold;'
            ),
//        'BRACKETS' => array(
//            0 => 'color: #66cc66;'
//            ),
        'STRINGS' => array(
            0 => 'color: #ff0000;'
            ),
        'NUMBERS' => array(
            0 => 'color: #0000dd;',
            GESHI_NUMBER_BIN_PREFIX_0B => 'color: #208080;',
            GESHI_NUMBER_OCT_PREFIX => 'color: #208080;',
            GESHI_NUMBER_HEX_PREFIX => 'color: #208080;',
            GESHI_NUMBER_FLT_SCI_SHORT => 'color:#800080;',
            GESHI_NUMBER_FLT_SCI_ZERO => 'color:#800080;',
            GESHI_NUMBER_FLT_NONSCI_F => 'color:#800080;',
            GESHI_NUMBER_FLT_NONSCI => 'color:#800080;'
            ),
        'METHODS' => array(
            ),
        'SYMBOLS' => array(
            0 => 'color: #33cc33;',
            1 => 'color: #33cc33;'
            ),
        'SCRIPT' => array(
            ),
        'REGEXPS' => array(
            0 => 'color: #b100b1; font-weight: bold;',
            1 => 'color: #448844;',
            2 => 'color: #448888;',
            3 => 'color: #448888;'
            )
        ),
    'OOLANG' => false,
    'OBJECT_SPLITTERS' => array(
        ),
    'URLS' => array(
        1 => 'help/index-asm/word/{FNAMEL}',
        2 => 'help/index-asm/word/{FNAMEL}',
        3 => 'help/index-asm/word/{FNAMEL}',
        4 => 'help/index-asm/word/{FNAMEL}',
        5 => 'help/index-asm/word/{FNAMEL}',
        ),
    'REGEXPS' => array(
        //Hex numbers
        0 => '\$[0-9a-fA-F]+',
        //Characters
        1 => '\#(?:\$[0-9a-fA-F]{1,2}|\d{1,3})',
        2 => array(
                   GESHI_SEARCH => '(.*)(endx)',
                   GESHI_REPLACE => '\\2',
                   GESHI_MODIFIERS => 'sU',
                   GESHI_BEFORE => '\\1',
                   GESHI_AFTER => '\\3'
             )
        ),

//    'REGEXPS' => array(
////        /* Label */
//        0 => array(
//           GESHI_SEARCH => '((?si:[@\s]+GOTO\s+|\s+:)[\s]*)((?<!\n)[^\s\n]*)',
//            GESHI_SEARCH => '((?si:[@\s]+GOTO\s+|\s+:)[\s]*)((?<!\n)[^\s\n]*)',
//            GESHI_REPLACE => '\\2',
//            GESHI_MODIFIERS => 'si',
//            GESHI_BEFORE => '\\1',
//            GESHI_AFTER => ''
//        ),
//        ),
    'STRICT_MODE_APPLIES' => GESHI_NEVER,
    'SCRIPT_DELIMITERS' => array(),
//        0 => array(' ' => ' ')
//        ),
    'HIGHLIGHT_STRICT_BLOCK' => array(
//        0 => true,
//        1 => true,        2 => true,
//        3 => true,        4 => true,
//        5 => true
        ),
    'TAB_WIDTH' => 4,

    'PARSER_CONTROL' => array(
        'ENABLE_FLAGS' => array(
//            'BRACKETS' => GESHI_NEVER,
            'NUMBERS' => GESHI_ALWAYS
            ),
            // à éplucher à fond http://qbnz.com/highlighter/geshi-doc.html#language-file-parser-control
        'KEYWORDS' => array(
//            'SPACE_AS_WHITESPACE' => true,

//            1 => array(
//                'DISALLOWED_AFTER' => ': '
//                ),
//            1 => array(
////                'DISALLOWED_BEFORE' => '(?<="|"\/)'
//                ),
//            2 => array(
//                'DISALLOWED_BEFORE' => '(?<![\w\-])'
//                ),
//            3 => array(
//                'ENT_NOQUOTES'
//                ),
//            4 => array(
//                'DISALLOWED_BEFORE' => '(?<!\w)'
//                )
            ),
        'STYLES' => array(),
        )
);

