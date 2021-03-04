<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperRelatedItems extends CopperResource
{
    /**
     * View all records related to an Entity
     *
     * @see https://developer.copper.com/related-items/view-all-records-related-to-an-entity.html
     * @param string $entity
     * @param string $entityId
     * @return stdClass
     */
    public function all(string $entity, string $entityId) {

        return $this->client->get("$entity/$entityId/related");
    }

    /**
     * View all records of a given Entity Type related to an Entity
     *
     * @see https://developer.copper.com/related-items/view-all-records-of-a-given-entity-type-related-to-an-entity.html
     * @param string $entity
     * @param string $entityId
     * @param string $relatedEntityName
     * @return stdClass
     */
    public function byEntity(string $entity, string $entityId, string $relatedEntityName) {

        return $this->client->get("$entity/$entityId/related/$relatedEntityName");
    }

    /**
     * Relate an existing record to an Entity
     *
     * @see https://developer.copper.com/related-items/view-all-records-related-to-an-entity.html
     * @param string $entity
     * @param string $entityId
     * @param array $options
     * @return stdClass
     */
    public function create(string $entity, string $entityId, array $options) {

        return $this->client->post("$entity/$entityId/related", $options);
    }

    /**
     * Remove relationship between record and Entity
     *
     * @see https://developer.copper.com/related-items/remove-relationship-between-record-and-entity.html
     * @param string $entity
     * @param string $entityId
     * @param array $options
     * @return stdClass
     */
    public function delete(string $entity, string $entityId, array $options) {

        return $this->client->delete("$entity/$entityId/related", $options);
    }

}
