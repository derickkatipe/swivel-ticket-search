<?php

namespace App\DomainModels;

use App\Repositories\Contracts\TicketSearchRepositoryInterface;

/**
 * Class TicketSearch
 * @package App\DomainModels
 */
class TicketSearch
{
    /**
     * @var TicketSearchRepositoryInterface
     */
    private $ticketSearchRepo;

    /**
     * TicketSearch constructor.
     * @param TicketSearchRepositoryInterface $ticketSearchRepo
     */
    public function __construct(
        TicketSearchRepositoryInterface $ticketSearchRepo
    ) {
        $this->ticketSearchRepo = $ticketSearchRepo;
    }

    /**
     * Get search type list from configuration
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getSearchTypeList()
    {
        return config('ticketsearch.search_types', null);
    }

    /**
     * Get search fields for the selected search type
     *
     * @param $arrInput
     * @return mixed
     */
    public function getSearchFieldListForSearchType($arrInput)
    {
        $data = config('ticketsearch.search_fields', null);
        return  $data[$arrInput['type']];
    }

    /**
     * Get search results for the selected search filters
     *
     * @param $arrInput
     * @return array
     */
    public function searchResults($arrInput)
    {
        $data = [];
        switch ($arrInput['type']) {
            case 0:
                $data = $this->getOrganizationTicketData($arrInput);
                break;
            case 1:
                $data = $this->getUserTicketData($arrInput);
                break;
            case 2:
                $data = $this->getTicketTicketData($arrInput);
                break;
        }
        return $data;
    }

    /**
     * Filter ticket data based on the organization search parameters
     *
     * @param $arrInput
     * @return array
     */
    private function getOrganizationTicketData($arrInput)
    {
        $val = $arrInput['val'];
        $field = $arrInput['field'];
        $allOrganizations = $this->ticketSearchRepo->getAllOrganizations();
        $allTickets = $this->ticketSearchRepo->getAllTickets();
        $allUsers = $this->ticketSearchRepo->getAllUsers();

        $organizations = $allOrganizations->filter(function ($item) use ($field, $val) {
            // to filter by tags, domain check whether field is an array
            if (is_array($field)) {
                return in_array($val, $item[$field]) === true;
            } else {
                return false !== stristr($item[$field], $val);
            }
        });

        $tickets = [];
        $assignee = [];

        foreach ($organizations as $organization) {
            $ticketsTemp = $allTickets->where('organization_id', $organization['_id']);

            $assignee = array_merge($assignee, $ticketsTemp->pluck('assignee_id')->toArray());
            $tickets = array_merge($tickets, $ticketsTemp->toArray());
        }

        $assigneeCollection = $allUsers->whereIn('_id', $assignee);

        foreach ($tickets as $key => $ticket) {
            $tickets[$key]['assignee'] = $assigneeCollection->where('_id', $ticket['assignee_id'])->first()['name'];
        }
        return $tickets;
    }

    /**
     * Filter ticket data based on the ticket search parameters
     *
     * @param $arrInput
     * @return mixed
     */
    private function getTicketTicketData($arrInput)
    {
        $users = $this->ticketSearchRepo->getAllUsers();
        $allOrganizations = $this->ticketSearchRepo->getAllOrganizations();

        $tickets = $this->ticketSearchRepo->getTicketsByFieldAndValue(
            $arrInput['field'],
            $arrInput['val']
        );

        foreach ($tickets as $key => $ticket) {
            $userData = $users->filter(function ($user) use ($ticket) {
                return $ticket['submitter_id'] == $user['_id']
                    || $ticket['assignee_id'] == $user['_id'];
            });

            // There were some users without organization_id
            if (isset($ticket['organization_id'])) {
                $Organizations = $allOrganizations
                    ->where('_id', $ticket['organization_id'])
                    ->first();
                $tickets[$key]['ticket_organization'] = $Organizations['name'];
            } else {
                $tickets[$key]['ticket_organization'] = '';
            }

            foreach ($userData as $user) {
                if ($user['_id'] == $ticket['submitter_id'] || !isset($tickets[$key]['ticket_submitter_name'])) {
                    $tickets[$key]['ticket_submitter_name'] = $user['name'];
                }
                $tickets[$key]['ticket_asignee_name'] =
                    (isset($ticket['assignee_id']) && $user['_id'] == $ticket['assignee_id'] || !isset($tickets[$key]['ticket_asignee_name']))
                        ? $user['name'] : $tickets[$key]['ticket_asignee_name'];
            }
        }
        return $tickets;
    }

    /**
     * Filter tickets based on the user search parameters
     *
     * @param $arrInput
     * @return mixed
     */
    private function getUserTicketData($arrInput)
    {
        $allUsers = $this->ticketSearchRepo->getAllUsers();
        $allOrganizations = $this->ticketSearchRepo->getAllOrganizations();
        $allTickets = $this->ticketSearchRepo->getAllTickets();

        $filteredUsers = $allUsers
            ->where($arrInput['field'], $arrInput['val']);

        $users = [];
        $users = array_merge($users, $filteredUsers->pluck('_id')->toArray());
        $assigneeTickets = $allTickets->whereIn('assignee_id', $users);
        $submitterTickets = $allTickets->whereIn('submitter_id', $users);
        $ticketsArray = $assigneeTickets->union($submitterTickets)->all();

        foreach ($filteredUsers as $filterUser)
        {
            if (isset($filterUser['organization_id'])) {
                $submitterOrganization = $allOrganizations
                    ->where('_id', $filterUser['organization_id'])
                    ->first();
            }

            $organizationName = isset($submitterOrganization['name'])
                ? $submitterOrganization['name'] : '';

            foreach ($ticketsArray as $key => $ticket) {
                $ticketsArray[$key]['user_organization'] = $organizationName;

            }
        }
        return $ticketsArray;
    }
}
