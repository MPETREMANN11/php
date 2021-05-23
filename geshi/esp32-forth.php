<?php
/*************************************************************************************
 * Complete GeSHi librarie for ESP32 FORTH language
 ************************************************************************************/

/*
 editor list copy thru load flush update empty-buffers buffer block save-buffers 
 default-use use open-blocks block-id scr block-fid camera bterm webui web-interface 
 streams pause start-task task tasks words vlist order see .s startswith? str= 
 forget dump assert dump-file include included bluetooth Serial ledc SPIFFS SD_MMC 
 WiFi WebServer Wire resize free allocate ok LED OUTPUT INPUT HIGH LOW page tone 
 freq duty adc pin internals sealed also transfer{ }transfer ?transfer transfer 
 definitions vocabulary forth ok quit evaluate prompt refill tib accept echo 
 fill cmove> cmove z>s s>z r| r" z" ." s" $place n. octal 
  str #> sign #s # hold <# extract pad hld cr space emit bye key? key type 
 is defer to value throw catch handler j i loop +loop leave unloop ?do do next 
 for depth rp0 sp0 variable constant postpone >body >flags >link >link& >name 
 abs max min aft repeat while else if then ahead until again begin literal [char] 
 char ['] ' ] [ c, , align aligned allot here context current base state >in 
 #tib 'tib cell/ cells cell+ +! 4/ 4* 2/ 2* 1- 1+ nl bl 0<> <> = > < -rot rot 
 - negate invert mod / /mod * *_/ rdrop nip 2dup 2drop ( YIELD IMMEDIATE 
 DOES> CREATE S>NUMBER? PARSE FIND CELL EXECUTE R@ R> >R RP! RP@ SP! SP@ C! L! 
 ! C@ L@ @ DROP OVER SWAP DUP XOR OR AND *_/MOD U/MOD + 0< 0= SD_MMC.begin MDNS.begin 
 FILE-SIZE RESIZE-FILE REPOSITION-FILE FILE-POSITION READ-FILE WRITE-FILE DELETE-FILE 
 CREATE-FILE OPEN-FILE FLUSH-FILE CLOSE-FILE BIN W/O R/W R/O TERMINATE MS analogRead 
 digitalRead digitalWrite pinMode
*/


$language_data = array (
    'LANG_NAME' => 'esp32-FORTH',
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
            '.', '?', 'u.',
            '+', '-', '*', '*/',
            '/', '/mod', 'mod',
            ':', '<semi>', 
            "#", '&lt;#', '#s', '#&gt;', 'hold',
            '1+', '1-',
            '2dup', '2drop',
            'align', 'also',  'and',
            'cr',
            'definitions',  'dup', 'drop', 'does&gt;',
            'emit', 'execute', 'exit',
            'here',
             'i', 'j',
            'decimal', 'hex', 'binary', 'octal',
            'only', 'or', 'order', 
            'r<PIPE>',
            'see', 'space', 'spaces',
            'type', 'to',
            'vlist',
            'words',
            'xor',

            // bluetooth vocabulary
            'bluetooth', 

            // camera vocabulary
            'camera',
            
            // editor vocabulary
            'editor',
            
            // forth vocabulary
            'forth',
            
            // INTERRUPTS vocabulary
            'INTERRUPTS',
            
            // ledc vocabulary
            'ledc',
            
            // SD_MMC vocabulary
            'SD_MMC', 
            
            // serial vocabulary
            'serial',
            'serial.flush', 'Serial.write', 'Serial.readBytes', 
            'Serial.available', 'Serial.end', 'Serial.begin',

            // SPIFFS vocabulary
            'SPIFFS',
            
            // TASKS vocabulary
            'TASKS',
            
            // WebServer vocabulary
            'WebServer', 
            
            // wifi vocabulary
            'wifi', 
            'WIFI_MODE_APSTA', 'WIFI_MODE_AP', 'WIFI_MODE_STA', 'WIFI_MODE_NULL',
            'WiFi.getTxPower', 'WiFi.setTxPower', 'WiFi.mode', 'WiFi.localIP',
            'WiFi.macAddress', 'WiFi.status', 'WiFi.disconnect', 'WiFi.begin', 'WiFi.config',
            
            // wire vocabulary
            'wire',

            ),
        /* IF statement keywords */
        2 => array(
            'if', 'else', 'then',
            'begin', 'again',  'until', 'while', 'repeat',
            'for', 'next',
            '?do', 'do', 'loop',  '+loop', 'leave', 
            ),
        /* Internal commands */
        3 => array(
            'constant', 'create',
            'value',  'variable',
            'vocabulary',
            ),
        /* constantes et variables */
        4 => array(
            'base', 'false', 'true',
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

