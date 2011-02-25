<?php
/**
 * Zkratkova jmena pro aktualni dokumenty
 *
 * @author petr
 */
class Model_DocumentsShortcuts extends Zend_Db_Table_Abstract {
    /**
     * UUID dokumentu
     *
     * @var string
     */
    protected $_uuid;

    /**
     * zkratkovy retezec
     *
     * @var string
     */
    protected $_shortcut;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "documents_shortcuts";

    /**
     * sloupec primarniho klice
     *
     * @var string
     */
    protected $_primary = "uuid";

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = false;

    /**
     * reference na rodicovske tabulky
     *
     * @var array
     */
    protected $_referenceMap = array(
        "document" => array(
            "columns" => "uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        )
    );

    /**
     * vygeneruje zkratku a vraci jeji objekt
     *
     * @return Zend_Db_Table_Row
     */
    public function generateShortcut($uuid) {
	//vyhledani volne zkratky
	$shortCut = "";

	do {
	    $shortCut = sha1($shortCut.$uuid);
	    $shortCut = substr($shortCut, 5, 7);

	    $row = $this->fetchRow($this->select(false)
		    ->where("shortcut like ?", $shortCut));
	} while ($row);

	//ulozeni nove zkratky
	$row = $this->createRow(array(
	    "uuid" => $uuid,
	    "shortcut" => $shortCut
	));

	$row->save();

	return $row;
    }
}
?>
