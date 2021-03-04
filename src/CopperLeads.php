<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperLeads extends CopperResource
{

    /**
     * Fetch Lead by ID
     *
     * @see    https://developer.copper.com/leads/fetch-a-lead-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id)
    {
        return $this->client->get("leads/$id");
    }

    /**
     * Create a New Lead
     *
     * @see    https://developer.copper.com/leads/create-a-new-lead.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function create(array $options)
    {
        return $this->client->post('leads', $options);
    }

    /**
     * Update A Lead
     *
     * @see   https://developer.copper.com/leads/update-a-lead.html
     * @param  string $id
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function update(string $id, array $options)
    {
        return $this->client->put("leads/$id", $options);
    }

    /**
     * Delete a Lead
     *
     * @see    https://developer.copper.com/leads/delete-a-lead.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id)
    {
        return $this->client->delete("leads/$id");
    }

    /**
     * UPSERT a Lead
     *
     * @see    https://developer.copper.com/leads/upsert-a-lead.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function upsert(array $options)
    {
        return $this->client->put('leads/upsert', $options);
    }

    /**
     * Convert a Lead
     *
     * @see    https://developer.copper.com/leads/convert-a-lead.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function convert(string $id, array $options = [])
    {
        return $this->client->post("leads/$id/convert", $options);
    }

    /**
     * List Leads (Search)
     *
     * @see    https://developer.copper.com/leads/list-leads-search.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function search(array $options = [])
    {
        return $this->client->post("leads/search", $options);
    }

    /**
     * See a Lead's Activities
     *
     * @see    https://developer.copper.com/leads/see-a-leads-activities.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function activities(string $id, array $options = [])
    {
        return $this->client->post("leads/$id/activities", $options);
    }

    /**
     * List Customer Sources
     *
     * @see    https://developer.copper.com/leads/list-customer-sources.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function sources() {

        return $this->client->get("customer_sources");
    }

    /**
     * List Lead Statuses
     *
     * @see    https://developer.copper.com/leads/list-lead-statuses.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function statuses() {

        return $this->client->get("lead_statuses");
    }

    /**
     * View Tasks related to a given Lead
     *
     * @param string $leadId
     */
    public function tasks(string $leadId) {

        return $this->client->get("lead/$leadId/related/tasks");
    }


}
