<?php
/*************************************************************************************
 *
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
    'LANG_NAME' => 'FORTH',
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
        ),
    'KEYWORDS' => array(
        /* Flow control keywords */
        1 => array(
            // *** non classés et non documentés ***
//            'ihere', 'char', "'", 'lit',
//            'prompt', 'quit',
//            'shb', 'interpret',
//            'source', 'tiu', 'tib', 'ti#', 'number?', '&gt;number', 'ud/mod',
//            'ud*', 'sign?', 'digit?', 'find', 'immed?', 'f',
//            'skip', 'n=', 'rshift', 'lshift',
//                'ud.',  // 'd2*',
//            'rdrop', 'endit',
//            'in,',
//            'place', 'word', 'parse',  'up',
//            'chars', 'char+', 'cells', 'cell+', 'aligned', 'cell',
            // *************************************
            "'key?", "'key", "'emit",
            "a&gt;", "&gt;a", "r&gt;p",
            "@p", "p++", "p+", "p2+", "pc!", "p!", "p@", "r&gt;p", "!p&gt;r", "!p", "pc!", "pc@",
            "#", '&lt;#', '#s', '#&gt;', 'hold',

            '(',
            "[']", '[', ']', '[char]',
            '+', '-', '*', '/', '*/', '/mod', 'mod', '*/mod', 'ud/mod',
            's&gt;d', 'd&gt;s', 'd+', 'd-', 'dnegate', '?dnegate', 'dabs', 'dmin', 'dmax',
            '&gt;number', '&gt;pr',
            '=', '0=', '&gt;', '0&gt;', '0&lt;', '&lt;', '&lt;&gt;',
                'u&gt;',  'ul&t;', 'within',
            ',',
            '$!',
            '1', '1+', '1-', '2+', '2-',
            '.', '.&quot;',  ',&quot;',
//            '&quot;',
            '@', '!', '2@', '2!', '+!',
            'd.', 'u.', 'ud.',
            '.&quot', 'u.r',
            '.id',
            '.st',
            '&gt;r', 'r&gt;', 'r@', '.r',
            '?negate',
            '2*', '2/', '2dup', '2drop', '2nip', '2over', '2tuck', '2rot',
            'abort', 'ascii', '?abort', '?abort?', 'abort&quot;',  'align',
            'allot', 'also',
            'and', 'or', 'xor', 'invert',
            'busy', 'idle',
            'c!', 'c,', 'c@', 'c@+', 'cr',
            'c&gt;n', 'n&gt;c',
            'cmove',
            'cwd',
            'd&gt;', 'd&lt;', 'd=', 'd0&lt;', 'd0=', 'dinvert',
            'd2/', 'd2*',
            'decimal', 'di', 'dup', 'dump',  '?dup', 'drop',
            'definitions',
            'eeprom',
            'ei', 'emit', 'empty',
            'execute',
            'exit',
            'Fcy', 'fl-', 'fl+', 'flash',
            'forth',
            'key', 'key?',
            'here', 'hex', 'hi',
            'i,', 'ic,', 'int!',
            'iflush',
            'immed?', 'immediate',
            'inline', 'inlined',
            'interpret',
            'is',
            'literal',
            'load', 'load+', 'load-',
            'lshift',
            'm+',
            'marker', 'mclr', 'mset', 'mtst',
            'min', 'max',
            'negate', 'nip',
            'only', 'order', 'over',
            'pick', 'postpone', 'prompt',
            'ram',
            'recurse',
            'roll', 'rot', '-rot',
            'rshift',
            's&quot;',  'swap', '2swap',
            'scan', 'space', 'spaces', 'state',
            'ticks', 'turnkey', 'type', 'tuck',
            'u/mod',
            'umin', 'umax',
            'value',
            'vocabulary', 'vocs',
            'warm',
            'words',
            // spécifique FLASH FORTH
            'bin',
            'ms',
            'operator', /* multi tâche: */
                'task:', 'tinit', 'run', 'end', 'single', 'tasks',
            'rx1?', 'rx1', 'tx1', 'rx0?', 'rx0', 'tx0',
            'to',
            'ver',
            'wd+', 'wd-',
            'xa&gt;', '&gt;xa',
            'x!', 'x@',
            // registres FlashForth
            'PORTA', 'PORTB', 'PORTC', 'PORTD', 'PORTE',
            'DDRA', 'DDRB', 'DDRC', 'DDRD', 'DDRE',
            'PINA', 'PINB', 'PINC', 'PIND', 'PINE',
            // personnal words
            'high', 'low', 'output', 'input', 'pin@',
            // spécifiques gForth
            'dbg', 'break:', 'break&quot;',
            'page', 'at-xy',
            // extension MATH.TXT
            "m*", "sm/rem", "fm/mod", "/mod", "mod", "*/mod", "*/", "ut*",
            "ut/", "um*/", "m*/",
            // I2C words
            "i2c.wait", "i2c.start", "i2c.stop", "i2c.restart",
            "i2c.tx", "i2c.rx", "i2c.rxn", "i2c.status", "i2c.ping?",

            // **** META COMPILER **********************************************
            // 'code:', ';end-code',
            'meta',

            ),
        /* IF statement keywords */
        2 => array(
            'if', 'else', 'then',
            'do', 'loop', '+loop', // 'i', 'j', 'k',
            'for', 'next',
            'begin', 'again',  'while', 'repeat', 'until',
            '[if]', '[ifdef]', '[inundef]', '[else]', '[endif]', '[then]',
            ),
        /* Internal commands */
        3 => array(
            '<semi>i',  ':', '<semi>', '2constant', '2variable', 'fvariable',
            'create',  'does&gt;',
            'constant', 'defer', 'recurse', 'value', 'variable',
            // personnal words
            'defPin:',
            ':noname',
            'string',
            'user',
            ),
        /* constantes et variables */
        4 => array(
            'base', 'false', 'true',
            "'emit", "'key", "'key?",
            "'source",
            "&gt;in"
            ),
//        ),
        /*Operands*/
//        5 => array()
        ),
    'SYMBOLS' => array(),
    'CASE_SENSITIVE' => array(
        GESHI_COMMENTS => false,
        1 => false,
        2 => false,
        3 => false,
        4 => false,
        ),
    'STYLES' => array(
        'KEYWORDS' => array(
            1 => 'color: #0099aa;',
            2 => 'color: #0000ff; background-color: white; font-weight: bold;',
            3 => 'color: #ff7777; font-weight: bold;',
            4 => 'color: #ff77ff; font-weight: bold;'
            ),
        'COMMENTS' => array(
            1 => 'color: #808080; font-style: italic;',
            2 => 'color: #b100b1; font-style: italic;',
            2 => 'color: #b100b1; font-style: italic;',
            3 => 'color: #33cc33;'
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
        1 => 'help/index/word/{FNAMEL}',
        2 => 'help/index/word/{FNAMEL}',
        3 => 'help/index/word/{FNAMEL}',
        4 => 'help/index/word/{FNAMEL}',
        ),
    'REGEXPS' => array(
        //Hex numbers
        0 => '\$[0-9a-fA-F]+',
        //Characters
        1 => '\#(?:\$[0-9a-fA-F]{1,2}|\d{1,3})',
        2 => array(GESHI_SEARCH => '(asm)(.*)(end)',
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

