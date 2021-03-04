<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperCustomActivities extends CopperResource
{
    /**
     * Get Custom Activity Type
     *
     * @see https://developer.copper.com/custom-fields/general/get-custom-activity-type.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("custom_activity_types/$id");
    }

    /**
     * List All Custom Activity Types
     *
     * @see https://developer.copper.com/custom-fields/general/list-all-custom-activity-types.html
     * @param string $id
     * @return stdClass
     */
    public function list() {

        return $this->client->get("custom_activity_types");
    }

    /**
     * Update an Existing Custom Activity Type
     *
     * @see https://developer.copper.com/custom-fields/general/update-an-existing-custom-activity-type.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("custom_activity_types/$id", $options);
    }

    /**
     * Create a New Custom Activity Type
     *
     * @see https://developer.copper.com/custom-fields/general/create-a-new-custom-activity-type.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("custom_activity_types", $options);
    }

}
