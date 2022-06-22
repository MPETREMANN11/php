<?php
/**
 * PHP script for highlighting FORTH source code
 * Filename:      Forth.php
 * Date:          22 june 2022
 * Updated:       22 june 2022
 * language:      PHP 7+
 * Copyright:     Marc PETREMANN
 * Marc PETREMANN
 * GNU General Public License
 */

class My_Forth {

    function __construct() {
        $this->enable_keyword_links = true; // activate external links
        $this->getKeywords();
    }

    // enable externam links
    var $enable_keywords_links;

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
        //$motsDefered    = $Glossaire->getListeMotsDefered();
        $Registers = new Application_Model_Registers;
        $this->keywords[5] = $Registers->getListeRegistres();
    }


    /**
     * Analyse and colorize FORTH code
     * @param  string $source
     * @return string
     */
    public function sourceForView($source) {
        $this->explodeSource($source);
        $outSource = $this->generateOutsource();
        return "<pre class='esp32-forth highlight_source' style='font-family:monospace;'>" . $outSource . "</pre>";
    }


    /**
     * Explode FORTH source code in array of keywords
     * @param type $code
     */
    private function explodeSource($code) {
        $lines = explode( "\n", str_replace("\r", "", $code));
        $this->keySource = array();
        foreach ($lines AS $line) {
            $this->keySource[] = explode(" ", $line);
        }
    }


    // if TRUE, tne end of line is a FORTH comment
    var $commentFlag;

    /**
     * Generate highlighted FORTH source code
     * @return string
     */
    private function generateOutsource() {
        $outSource = "";
        foreach ($this->keySource AS $line) {
            foreach ($line AS $word) {
                if (strlen($word)==0) {
                    $outSource .= " ";
                }   else {
                    $outSource .= $this->styliseWord($word);
                }
            }
            if ($this->commentFlag == TRUE) {
                $this->commentFlag = FALSE;
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
            1 => 'color: red; font-weight: bold;',          // definitions words
            2 => 'color: black; background-color: yellow;', // structure words
            3 => 'color: #ff00ff; font-weight: bold;',      // constants
            4 => 'color: black; font-weight: bold; background-color: #d7d7ff',  // vocabularies
            5 => 'color: green; background-color: #d9e9c6;', // registers
        'bin' => 'color: #7f00dd;',     // binaries values
        'dec' => 'color: #0000dd;',     // decimal values
        'hex' => 'color: #003ffd;',     // hexadecimal values
    );


    /**
     * highlight FORTH code
     * @param string $word
     */
    private function styliseWord($word) {
        if ($this->commentFlag == TRUE) {
            return $word ." ";
        }
        // test if  $word is a binary value
        $re = '/^[0-1]{8}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
//            return $this->linkifyBinNumber($word);
            return '<abbr style="' . $this->outStyle['bin'] . '" title="binary byte">' . $word . '</abbr> ';
        }
        // test if $word is a decimal value
        $re = '/^\d{1,}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
//            return $this->linkifyDecNumber($word);
            return '<abbr style="' . $this->outStyle['dec'] . '" title="number">' . $word . '</abbr> ';
        }
        // test if $word is a hexadecimal value
        $re = '/^\$[a-f0-9]{1,}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
//            return $this->linkifyHexNumber($word);
            return '<abbr style="' . $this->outStyle['hex'] . '" title="hexadecimal value">' . $word . '</abbr> ';
        }
        // if it's the word \ tag comment
        if (ord($word) == 92) {
            $this->commentFlag = TRUE;
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
        5 => 'help/reg-esp32/word/',
    );


    /**
     * include FORTH word in an external link
     * @param string $word
     * @param mixed  $level
     * @return string
     */
    private function linkifyWord($word, $level) {
        if ($this->enable_keyword_links) {
            return '<a href="' . $this->outlink[$level] . base64_encode($word) . '" style="' . $this->outStyle[$level] . '">' . $word . '</a> ';
        }
        return '<abbr style="' . $this->outStyle[$level] . '">' . $word . '</abbr> ';
    }

}
