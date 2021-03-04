<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperProjects extends CopperResource
{
    /**
     * Fetch a Project by ID
     *
     * @see https://developer.copper.com/projects/fetch-a-project-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("projects/$id");
    }

    /**
     * Create a New Project
     *
     * @see https://developer.copper.com/projects/create-a-new-project.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("projects", $options);
    }

    /**
     * Update a Project
     *
     * @see https://developer.copper.com/projects/update-a-project.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("projects/$id", $options);
    }

    /**
     * Delete a Project
     *
     * @see https://developer.copper.com/projects/delete-a-project.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("projects/$id");
    }

    /**
     * List Projects (Search)
     *
     * @see https://developer.copper.com/projects/list-projects-search.html
     * @param array $options
     * @return stdClass
     */
    public function search(array $options) {

        return $this->client->post("projects/search", $options);
    }
}
