<?php
/**
 * reprezentace tabulky asociaci dokumentu a adresaru
 *
 * @author petr
 */
class Model_DocumentsDirectoriesHasManyDocuments extends Zend_Db_Table_Abstract {
    /**
     * identifikacni cislo adresare
     *
     * @var int
     */
    protected $_document_directory_id;

    /**
     * UUID dokumentu
     *
     * @var string
     */
    protected $_document_uuid;

    /**
     * jmeno tabulky v databazi
     *
     * @var string
     */
    protected $_name = "documents_directories_has_many_documents";

    /**
     * seznam sloupcu primarniho klice
     *
     * @var array
     */
    protected $_primary = array(
        "document_directory_id",
        "document_uuid"
    );

    /**
     * indikace auto_increment
     *
     * @var bool
     */
    protected $_sequence = false;

    /**
     * referencni mapa na rodicovske tabulky
     *
     * @var array
     */
    protected $_referenceMap = array(
        "directory" => array(
            "columns" => "document_directory_id",
            "refTableClass" => "Model_DocumentsDirectories",
            "refColumns" => "id"
        ),

        "document" => array(
            "columns" => "document_uuid",
            "refTableClass" => "Model_Documents",
            "refColumns" => "uuid"
        )
    );
}
?>
