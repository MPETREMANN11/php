<?php
/**
 * PHP script for highlighting FORTH source code
 * Filename:      Forth.php
 * Date:          22 june 2022
 * Updated:       03 july 2022
 * language:      PHP 7+
 * Copyright:     Marc PETREMANN
 * Marc PETREMANN
 * GNU General Public License
 */

class My_Forth {

    function __construct() {
        $this->enable_keyword_link = -1; // activate external links
//        $this->commentFlag = FALSE;
        $this->flagDecorate = TRUE;
        $this->getKeywords();
    }

    // enable external link
    var $enable_keyword_link;

    // initialize keywords array
    var $keywords;

    /**
     * fetch all forth words from database
     */
    private function getKeywords() {
        $Glossaire = new Application_Model_Glossaire;
        $this->keywords[0] = $Glossaire->getListeMotsOrdinaires();
        $this->keywords[1] = $Glossaire->getListeMotsDefinition();
        $this->keywords[2] = $Glossaire->getListeMotsStructure();
        $this->keywords[3] = $Glossaire->getVariablesConstantes();
        $this->keywords[4] = $Glossaire->getListeMotsVocabulaires();
        $this->keywords[5] = $Glossaire->getListeMotsDefered();
        $Registers = new Application_Model_Registers;
        $this->keywords[6] = $Registers->getListeRegistres();
    }


    /**
     * Analyse and colorize FORTH code
     * @param  string $source
     * @return string
     */
    public function sourceForView($source) {
        $source = str_replace("¤", "$", $source);
        return "<pre class='esp32-forth highlight_source' style='font-family:monospace;'>"
            . $this->generateOutsource($this->explodeSource($source)) . "</pre>";
    }


    /**
     * Explode FORTH source code in array of keywords
     * @param type $code
     * @return array
     */
    private function explodeSource($code) {
        $lines = explode( "\n", str_replace("\r", "", $code));
        $keySource = array();
        foreach ($lines AS $line) {
            $keySource[] = explode(" ", $line);
        }
        return $keySource;
    }


    /**
     * Generate highlighted FORTH source code
     * @return string
     */
    private function generateOutsource($keySource) {
        $outSource = "";
        foreach ($keySource AS $line) {
            foreach ($line AS $word) {
                if (strlen($word)==0) {
                    $outSource .= " ";
                }   else {
                    $outSource .= $this->styliseWord($word);
                }
            }
            if ($this->flagDecorate == FALSE) {
                $this->flagDecorate = true;
                $outSource .= "</span>";
            }
            $outSource .= "\n";
        }
        return $outSource;
    }


    /**
     * define all styles for decoration
     * @var array
     */
    var $outStyle = array(
            0 => 'color: #0000ff;',                         // normal words
            1 => 'color: red; font-weight: bold;" title="definition word"', 
            2 => 'color: black; background-color: yellow;', // structure words
            3 => 'color: #ff00ff; font-weight: bold;',      // constants
            4 => 'color: black; font-weight: bold; background-color: #d7d7ff',  // vocabularies
            5 => 'color: orange; font-style: italic;" title="defered word"',
            6 => 'color: green; background-color: #d9e9c6;', // registers
        'bin' => 'color: #7f00dd;',     // binaries values
        'dec' => 'color: #0000dd;',     // decimal values
        'hex' => 'color: #003ffd;',     // hexadecimal values
       'real' => 'color: #146361;',     // real values
    );

    // if true, word decoration is active
    var $flagDecorate;
    

    /**
     * highlight FORTH code
     * @param string $word
     */
    private function styliseWord($word) {
        if ($this->flagDecorate == FALSE) {
            return $word ." ";
        }
        // test if  $word is a binary value
        $re = '/^[0-1]{8}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return '<abbr style="' . $this->outStyle['bin'] . '" title="32 bytes binary byte">' . $word . '</abbr> ';
        }
        // test if $word is a decimal value
        $re = '/^[+-]?((\d+(\.\d*)?)|(\.\d+))$/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return '<abbr style="' . $this->outStyle['dec'] . '" title="32 bytes integer value">' . $word . '</abbr> ';
        }
        // test if $word is a real value ne or n.ne
        $re = '/^[+-]?((\d+(\.\d*)?)|(\.\d+))e$/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return '<abbr style="' . $this->outStyle['real'] . '" title="real value">' . $word . '</abbr> ';
        }
        // test if $word is a hexadecimal value
        $re = '/^\$[a-f0-9]{1,}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return '<abbr style="' . $this->outStyle['hex'] . '" title="32 bytes hexadecimal value">' . $word . '</abbr> ';
        }
        // if it's the word \ tag comment
        if (ord($word) == 92 && $this->flagDecorate == TRUE) {
            $this->flagDecorate = FALSE;
            return '<span style="color: #808080; font-style: italic;">' . $word ." ";
        }
        // test if  $word is a FORTH word
        foreach ($this->keywords AS $level => $listeMots) {
            if (in_array(strtoupper($word), $listeMots)) {
                return $this->linkifyWord($word, $level);
            }
        }
        return $word ." ";
    }


    /**
     * array of external links
     * @var array
     */
    var $outlink = array(
        0 => 'help/index-esp32/word/',
        1 => 'help/index-esp32/word/',
        2 => 'help/index-esp32/word/',
        3 => 'help/index-esp32/word/',
        4 => 'help/index-esp32/word/',
        5 => 'help/index-esp32/word/',
        6 => 'help/reg-esp32/word/',
    );


    /**
     * list of string marker and associated styles
     * @var array
     */
    var $stringmarker = array(
        '."'    => "color: green;",
    );


    /**
     * include FORTH word in an external link
     * @param string $word
     * @param mixed  $level
     * @return string
     */
    private function linkifyWord($word, $level) {
        if ($this->enable_keyword_link) {
            return '<a href="' . $this->outlink[$level] . base64_encode($word) . '" style="' . $this->outStyle[$level] . '">' . $word . '</a> ';
        }
        return '<abbr style="' . $this->outStyle[$level] . '">' . $word . '</abbr> ';
    }

}
