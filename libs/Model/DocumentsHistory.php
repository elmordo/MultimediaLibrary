<?php
/**
 * Tabulka uchovavajici relace mezi zmenami dokumentu
 *
 * @author petr
 */
class Model_DocumentsHistory extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo zmeny
     *
     * @var int
     */
    protected $_id;

    /**
     * UUID nove verze dokumentu
     *
     * @var string
     */
    protected $_document_new_uuid;

    /**
     * UUID stare verze dokumentu
     *
     * @var string
     */
    protected $_document_old_uuid;

    /**
     * UUID nejstarsi verze dokumentu
     *
     * @var string
     */
    protected $_document_first_uuid;

    /**
     * UUID aktualni verze dokumentu
     *
     * @var string
     */
    protected $_document_current_uuid;

    /**
     * cas vytvoreni zaznamu
     *
     * @var string
     */
    protected $_created_at;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "documents_history";

    /**
     * sloupec primarniho klice
     *
     * @var string
     */
    protected $_primary = "id";

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = true;

    /**
     * referencni mapa na rodicovske tabulky
     *
     * @var array
     */
    protected $_referenceMap = array(
        "old" => array(
            "columns" => "document_old_uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        ),

        "new" => array(
            "columns" => "document_new_uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        ),

        "first" => array(
            "columns" => "document_first_uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        ),

        "last" => array(
            "columns" => "document_last_uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        )
    );
}
?>
