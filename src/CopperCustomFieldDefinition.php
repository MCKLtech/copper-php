<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperCustomFieldDefinition extends CopperResource
{
    /**
     * Fetch a Custom Field Definition
     *
     * @see https://developer.copper.com/custom-fields/general/fetch-a-custom-field-definition.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("custom_field_definitions/$id");
    }

    /**
     * List Custom Field Definitions
     *
     * @see https://developer.copper.com/custom-fields/general/list-custom-field-definitions.html
     * @param string $id
     * @return stdClass
     */
    public function list() {

        return $this->client->get("custom_field_definitions");
    }

    /**
     * Update an existing custom field definition
     *
     * @see https://developer.copper.com/custom-fields/general/update-an-existing-custom-field-definition.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("custom_field_definitions/$id", $options);
    }

    /**
     * Create a new custom field definition
     *
     * @see https://developer.copper.com/custom-fields/general/create-a-new-custom-field-definition.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("custom_field_definitions", $options);
    }

    /**
     * CDelete a Custom Field Definition
     *
     * @see https://developer.copper.com/custom-fields/general/delete-a-custom-field-definition.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("custom_field_definitions/$id");
    }

}
