<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperOpportunities extends CopperResource
{
    /**
     * Fetch an Opportunity by ID
     *
     * @see https://developer.copper.com/opportunities/fetch-an-opportunity-by-id.html
     * @param string $id
     * @return stdClass
     */
    public function get(string $id) {

        return $this->client->get("opportunities/$id");
    }

    /**
     * Create a New Opportunity
     *
     * @see https://developer.copper.com/opportunities/create-a-new-opportunity.html
     * @param array $options
     * @return stdClass
     */
    public function create(array $options) {

        return $this->client->post("opportunities", $options);
    }

    /**
     * Update an Opportunity
     *
     * @see https://developer.copper.com/opportunities/update-an-opportunity.html
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function update(string $id, array $options) {

        return $this->client->put("opportunities/$id", $options);
    }

    /**
     * Delete an Opportunity
     *
     * @see https://developer.copper.com/opportunities/delete-an-opportunity.html
     * @param string $id
     * @return stdClass
     */
    public function delete(string $id) {

        return $this->client->delete("opportunities/$id");
    }

    /**
     * List Opportunities (Search)
     *
     * @see https://developer.copper.com/opportunities/list-opportunities-search.html
     * @param array $options
     * @return stdClass
     */
    public function search(array $options) {

        return $this->client->post("opportunities/search", $options);
    }

    /**
     * List Customer Sources
     *
     * @see https://developer.copper.com/opportunities/list-customer-sources.html
     * @return stdClass
     */
    public function customerSources() {

        return $this->client->get("customer_sources");
    }

    /**
     * List Loss Reasons
     *
     * @see https://developer.copper.com/opportunities/list-loss-reasons.html
     * @return stdClass
     */
    public function lossReasons() {

        return $this->client->get("loss_reasons");
    }

    /**
     * List Pipelines
     *
     * @see https://developer.copper.com/opportunities/list-pipelines.html
     * @return stdClass
     */
    public function pipelines() {

        return $this->client->get("pipelines");
    }

    /**
     * List Pipeline Stages
     *
     * @see https://developer.copper.com/opportunities/list-pipeline-stages.html
     * @return stdClass
     */
    public function pipelineStages() {

        return $this->client->get("pipeline_stages");
    }

    /**
     * List Stages in a Pipeline
     *
     * @see https://developer.copper.com/opportunities/list-stages-in-a-pipeline.html
     * @return stdClass
     */
    public function stagesInPipeline(string $pipelineId) {

        return $this->client->get("pipeline_stages/pipeline/$pipelineId");
    }



}
