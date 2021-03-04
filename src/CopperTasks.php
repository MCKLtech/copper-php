<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperTasks extends CopperResource
{
    /**
     * Fetch a Task by ID
     *
     * @see https://developer.copper.com/tasks/fetch-a-task-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("tasks/$id");
    }

    /**
     * Create a New Tasks
     *
     * @see https://developer.copper.com/tasks/create-a-new-task.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("tasks", $options);
    }

    /**
     * Update a Task
     *
     * @see https://developer.copper.com/tasks/update-a-task.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("tasks/$id", $options);
    }

    /**
     * Delete a Task
     *
     * @see https://developer.copper.com/tasks/delete-a-task.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("tasks/$id");
    }

    /**
     * List Tasks (Search)
     *
     * @see https://developer.copper.com/tasks/list-tasks-search.html
     * @param array $options
     * @return stdClass
     */
    public function search(array $options) {

        return $this->client->post("tasks/search", $options);
    }
}
