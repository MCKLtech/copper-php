<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperPeople extends CopperResource
{
    /**
     * Wrapper to fetch by ID or Email
     *
     * @param string $id_or_email
     * @return stdClass
     */
    public function get(string $id_or_email) {

        if (filter_var($id_or_email, FILTER_VALIDATE_EMAIL)) {

            return $this->getByEmail($id_or_email);
        }

        else return $this->getByID($id_or_email);
    }

    /**
     * Fetch a Person by ID
     *
     * @see    https://developer.copper.com/people/fetch-a-person-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function getByID(string $id)
    {
        return $this->client->get("people/$id");
    }

    /**
     * Fetch a Person by Email
     *
     * @see    https://developer.copper.com/people/fetch-a-person-by-email.html
     * @param string $id
     * @return stdClass
     */
    public function getByEmail(string $email)
    {
        return $this->client->post("people/fetch_by_email", ['email' => $email]);
    }

    /**
     * Create a New Person
     *
     * @see    https://developer.copper.com/people/create-a-new-person.html
     * @param string $id
     * @return stdClass
     */
    public function create(array $options)
    {
        return $this->client->post("people", $options);
    }

    /**
     * Update a Person
     *
     * @see    https://developer.copper.com/people/update-a-person.html
     * @param string $id
     * @return stdClass
     */
    public function update(string $id, array $options)
    {
        return $this->client->put("people/$id", $options);
    }

    /**
     * Delete a Person
     *
     * @see    https://developer.copper.com/people/delete-a-person.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id)
    {
        return $this->client->delete("people/$id");
    }

    /**
     * List People (Search)
     *
     * @see    https://developer.copper.com/people/list-people-search.html
     * @param string $id
     * @return stdClass
     */
    public function search(array $options = [])
    {
        return $this->client->post("people/search", $options);
    }

    /**
     * See a Person's Activities
     *
     * @see    https://developer.copper.com/people/see-a-persons-activities.html
     * @param string $id
     * @return stdClass
     */
    public function activities(string $id, array $options = [])
    {
        return $this->client->post("people/search", $options);
    }

    /**
     * List Contact Types
     *
     * @see    https://developer.copper.com/people/list-contact-types.html
     * @param string $id
     * @return stdClass
     */
    public function types()
    {
        return $this->client->get("contact_types");
    }

    /**
     * View Companies related to a given Person
     * Note, return is limited to one Company by Copper
     *
     * @param string $personId
     * @return stdClass
     */
    public function companies(string $personId) {

        return $this->client->get("people/$personId/related/companies");
    }

    /**
     * View Tasks related to a given Person
     * @param string $personId
     * @return stdClass
     */
    public function tasks(string $personId) {

        return $this->client->get("people/$personId/related/tasks");
    }

    /**
     * View Opportunities related to a given Person
     * @param string $personId
     * @return stdClass
     */
    public function opportunities(string $personId) {

        return $this->client->get("people/$personId/related/opportunities");
    }

    /**
     * View Projects related to a given Person
     * @param string $personId
     * @return stdClass
     */
    public function projects(string $personId) {

        return $this->client->get("people/$personId/related/projects");
    }


}
