<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperCompanies extends CopperResource
{
    /**
     * Fetch a Company by ID
     *
     * @see https://developer.copper.com/companies/fetch-a-company-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("companies/$id");
    }

    /**
     * Create a New Company
     *
     * @see https://developer.copper.com/companies/create-a-new-company.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("companies", $options);
    }

    /**
     * Update a Company
     *
     * @see https://developer.copper.com/companies/update-a-company.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("companies/$id", $options);
    }

    /**
     * Delete a Company
     *
     * @see https://developer.copper.com/companies/delete-a-company.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("companies/$id");
    }

    /**
     * List Companies (Search)
     *
     * @see https://developer.copper.com/companies/create-a-new-company.html
     * @param array $options
     * @return stdClass
     */
    public function search(array $options) {

        return $this->client->post("companies/search", $options);
    }

    /**
     * See a Company's Activities
     *
     * @see https://developer.copper.com/companies/see-a-companys-activities.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function activities(string $id, array $options = []) {

        return $this->client->post("companies/$id/activities", $options);
    }

    /**
     * List Contact Types
     *
     * @see https://developer.copper.com/companies/list-contact-types.html
     * @return stdClass
     */
    public function types() {

        return $this->client->get("contact_types");
    }

    /**
     * View People related to a given Company
     * @param string $companyId
     * @return stdClass
     */
    public function people(string $companyId) {

        return $this->client->get("company/$companyId/related/people");
    }

    /**
     * View Tasks related to a given Company
     * @param string $companyId
     * @return stdClass
     */
    public function tasks(string $companyId) {

        return $this->client->get("company/$companyId/related/tasks");
    }

    /**
     * View Projects related to a given Company
     * @param string $companyId
     * @return stdClass
     */
    public function projects(string $companyId) {

        return $this->client->get("company/$companyId/related/projects");
    }

    /**
     * View Opportunities related to a given Company
     * @param string $companyId
     * @return stdClass
     */
    public function opportunities(string $companyId) {

        return $this->client->get("company/$companyId/related/opportunities");
    }

}
