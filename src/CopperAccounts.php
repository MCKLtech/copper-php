<?php


namespace Copper;

use Http\Client\Exception;
use stdClass;

class CopperAccounts extends CopperResource
{

    /**
     * Fetch Account Details
     *
     * @see    https://developer.copper.com/account-and-users/fetch-account-details.html
     * @return stdClass
     * @throws Exception
     */
    public function fetch()
    {
        return $this->client->get('account');
    }

    /**
     * Fetch an Account User by ID
     *
     * @see    https://developer.copper.com/account-and-users/fetch-user-by-id.html
     * @param string $id
     * @return stdClass
     * @throws Exception
     */
    public function getUser(string $id)
    {
        return $this->client->get('users/'.$id);
    }

    /**
     * List Account Users
     *
     * @see    https://developer.copper.com/account-and-users/list-users.html
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function listUsers(array $options = [])
    {
        return $this->client->post('users/search', $options);
    }
}
