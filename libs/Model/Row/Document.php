<?php
/**
 * Description of Document
 *
 * @author petr
 */
class Model_Row_Document extends Zend_Db_Table_Row_Abstract {
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
    
    public function save() {
	if (empty($this->_cleanData)) {
	    $this->_makeNewDocument();
	    return $this->uuid;
	}
	
	//vygenerovani noveho UUID
	$uuid = $this->_generateUUID();

	//vytvoreni radku tabulky a prekopirovani originalnich dat
	$newRow = new Zend_Db_Table_Row(array(
	    "table" => $this->_table,
	    "data" => $this->_cleanData
	));

	$newRow->uuid = $uuid;
	$newRow->save();

	//prepsani historie
	$tableHistory = new Model_DocumentsHistory();
	$thisHistory = $tableHistory->fetchRow($tableHistory->select(false)
		->where("document_new_uuid like ?", $this->uuid));

	$thisHistory->document_new_uuid = $uuid;
	$thisHistory->save();

	//vygenerovani nove historie
	$newHistory = $tableHistory->createRow();

	$newHistory->document_old_uuid = $uuid;
	$newHistory->document_new_uuid = $this->uuid;
	$newHistory->document_first_uuid = $thisHistory->document_first_uuid;
	$newHistory->document_last_uuid = $thisHistory->document_last_uuid;

	$newHistory->save();

	//ulozeni zmen tohoto dokumentu
	parent::save();

	return $this->uuid;
    }

    public function shortcut() {
	$tableShortcuts = new Model_DocumentsShortcuts();

	$shortcut = $tableShortcuts->fetchRow($tableShortcuts->select(false)
		->where("uuid like ?", $this->uuid));

	if (!$shortcut)
	    return false;
	else
	    return $shortcut->shortcut;
    }

    /**
     * vygeneruje nepouzite UUID
     *
     * @return string
     */
    protected function _generateUUID() {
	//kontrola jeslti soubor se stejnym UUID existuje
	$table = new Model_Documents();
	$row = "";

	do {
	    $uuid = sha1(time().microtime().$row);

	    $row = $table->fetchRow($table->select(false)
		    ->where("uuid like ?", $uuid));

	} while ($row);

	return $uuid;
    }

    /**
     *
     * @return Model_Row_Document
     */
    protected function _makeNewDocument() {
	//vygenerovani klice bazoveho dokumentu
	$baseUUID = $this->_generateUUID();

	//anulace _cleanData
	$this->_cleanData = array();
	$modifiedFileds = $this->_modifiedFields;

	//ulozeni prvniho dokumentu
	$this->uuid = $baseUUID;
	$this->is_latest = 0;
	parent::save();

	//ulozeni aktualniho dokumentu
	$currentUUID = $this->_generateUUID();

	//duplikace a anulace _cleanData
	$this->_cleanData = array();
	$this->_modifiedFields = $modifiedFileds;

	$this->uuid = $currentUUID;
	$this->is_latest = 1;
	parent::save();

	//vytvoreni zkratky
	$tableShortcuts = new Model_DocumentsShortcuts();
	$tableShortcuts->generateShortcut($currentUUID);

	//provazani historie
	$tableHistory = new Model_DocumentsHistory();
	$history = $tableHistory->createRow(array(
		"document_new_uuid" => $currentUUID,
		"document_old_uuid" => $baseUUID,
		"document_first_uuid" => $baseUUID,
		"document_last_uuid" => $currentUUID
	));

	$history->save();

	return $this;
    }
}
?>
