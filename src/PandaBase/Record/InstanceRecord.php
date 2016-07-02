<?php
/**
 * Created by PhpStorm.
 * User: nagyatka
 * Date: 16. 01. 16.
 * Time: 13:11
 */

namespace PandaBase\Record;



use PandaBase\Connection\TableDescriptor;

define("CREATE_INSTANCE",0);

abstract class InstanceRecord extends DatabaseRecord {

    /**
     * @param TableDescriptor $descriptor
     * @param int $id
     * @param array $values
     */
    function __construct(TableDescriptor $descriptor, $id,$values = null) {
        parent::__construct($descriptor, ($values == null) ? $this->getRecordHandler($descriptor)->select($id) : $values);
    }

    /**
     * @return bool
     */
    public function isValid() {
        return count($this->values) == 0 ? false : true;
    }

    /**
     *
     */
    public function remove() {
        $recordHandler = $this->getRecordHandler();
        $recordHandler->setManagedRecord($this);
        $recordHandler->remove();
    }

    /**
     * @return bool
     * @throws \PandaBase\Exception\TableDescriptorNotExists
     */
    public function isNewInstance() {
        return !isset($this->getAll()[$this->getTableDescriptor()->get(TABLE_ID)]);
    }

}