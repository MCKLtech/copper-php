<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperActivities extends CopperResource
{
    /**
     * Fetch an Activity by ID
     *
     * @see https://developer.copper.com/activities/fetch-an-activity-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("activities/$id");
    }

    /**
     * Create a New Activity
     *
     * @see https://developer.copper.com/activities/create-a-new-activity.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("activities", $options);
    }

    /**
     * Delete an Activity
     *
     * @see https://developer.copper.com/activities/delete-an-activity.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("activities/$id");
    }

    /**
     * List Activities (Search)
     *
     * @see https://developer.copper.com/tasks/list-tasks-search.html
     * @param array $options
     * @return stdClass
     */
    public function search(array $options) {

        return $this->client->post("activities/search", $options);
    }

    /**
     * List Activity Types
     *
     * @see https://developer.copper.com/activities/list-activity-types.html
     * @return stdClass
     */
    public function types() {

        return $this->client->get("activity_types");
    }
}
