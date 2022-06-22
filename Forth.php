<?php

class My_Forth {

    function __construct() {
        $this->enable_keyword_links = true; // documentation des mots activée
        $this->getKeywords();
    }

    var $enable_keywords_links;

    var $keywords;

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
     * Analyse et décore le code FORTH
     * @param  string $source
     * @return string
     */
    public function sourceForView($source) {
        $this->explodeSource($source);
        $outSource = $this->generateOutsource();
        return "<pre class='esp32-forth highlight_source' style='font-family:monospace;'>" . $outSource . "</pre>";
    }


    /**
     * Explose le code source en mots clés
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
     * génère le code source décoré
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
     * teste si le mot est un commentaire ou un mot défini dans FORTH
     * @param string $word
     */
    private function styliseWord($word) {
        if ($this->commentFlag == TRUE) {
            return $word ." ";
        }
        // teste si $word est une valeur binaire
        $re = '/^[0-1]{8}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return $this->linkifyBinNumber($word);
        }
        // teste si $word est une valeur décimale
        $re = '/^\d{1,}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return $this->linkifyDecNumber($word);
        }
        // teste si $word est une valeur hexadécimale
        $re = '/^\$[a-f0-9]{1,}/is';
        preg_match($re, $word, $matches, PREG_OFFSET_CAPTURE, 0);
        if (!empty($matches)) {
            return $this->linkifyHexNumber($word);
        }
        // si c'est le mot \ on marque le commentaire
        if (ord($word) == 92) {
            $this->commentFlag = TRUE;
            return '<span style="color: #808080; font-style: italic;">' . $word ." ";
        }
        // teste si $word est un mot FORTH
        foreach ($this->keywords AS $level => $listeMots) {
            if (in_array(strtoupper($word), $listeMots)) {
                return $this->linkifyWord($word, $level);
            }
        }
        return $word ." ";
    }

    private function linkifyBinNumber($word) {
        return '<abbr style="' . $this->outStyle['bin'] . '" title="binary byte">' . $word . '</abbr> ';
    }

    private function linkifyDecNumber($word) {
        return '<abbr style="' . $this->outStyle['dec'] . '" title="number">' . $word . '</abbr> ';
    }

    private function linkifyHexNumber($word) {
        return '<abbr style="' . $this->outStyle['hex'] . '" title="hexadecimal value">' . $word . '</abbr> ';
    }

    var $outlink = array(
        0 => 'help/index-esp32/word/',
        1 => 'help/index-esp32/word/',
        2 => 'help/index-esp32/word/',
        3 => 'help/index-esp32/word/',
        4 => 'help/index-esp32/word/',
        5 => 'help/reg-esp32/word/',
    );

    private function linkifyWord($word, $level) {
        if ($this->enable_keyword_links) {
            return '<a href="' . $this->outlink[$level] . base64_encode($word) . '" style="' . $this->outStyle[$level] . '">' . $word . '</a> ';
        }
        return '<abbr style="' . $this->outStyle[$level] . '">' . $word . '</abbr> ';
    }

}
