<?php
/**
 * Rozsireni radku o operaci s maskou opravneni
 *
 * @author petr
 */
class Model_Row_Directory extends Zend_Db_Table_Row_Abstract {
    const MASK_USER = 0;

    const MASK_GROUP = 3;

    const MASK_OTHER = 6;

    /**
     * vraci upravneni uzivatele vzhledem k adresari
     *
     * @param int $userId identifikacni cislo uzivatele
     * @param array $groups seznam skupin uzivatele
     * @return stdClass
     */
    public function getPermisions($userId, array $groups) {
        //kontorla uzivatel
        if ($this->user_id == $userId)
            return $this->_parseMaskSegment($this->mask, self::MASK_USER);
        elseif (in_array($this->group_id, $groups))
            return $this->_parseMaskSegment($this->mask, self::MASK_GROUP);
        else
            return $this->_parseMaskSegment($this->mask, self::MASK_OTHER);
    }

    /**
     * naparsuje cast cast masky opravneni
     *
     * @param string $mask maska pristupu k entite
     * @param int $segment segment masky kterou naparsovat
     * @return stdClass
     */
    protected function _parseMaskSegment($mask, $segment) {
        //inicializace vysledku
        $result = new stdClass();

        $result->read = false;
        $result->write = false;
        $result->execute = false;

        //nacteni segmentu masky
        $maskPart = substr($mask, $segment, 3);

        for ($i = 0; $i < 3; $i++) {
            switch ($maskPart[$i]) {
                case "w":
                    $result->write = true;
                    break;

                case "r":
                    $result->read = true;
                    break;

                case "x":
                    $result->execute = true;
                    break;
            }
        }

        return $result;
    }
}
?>
