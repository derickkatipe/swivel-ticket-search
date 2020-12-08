<?php

namespace App\Repositories;

use App\Repositories\Contracts\TicketSearchRepositoryInterface;
use App\Models\TicketModel;
use App\Models\OrganizationModel;
use App\Models\UserModel;

class TicketSearchRepository implements TicketSearchRepositoryInterface
{
    private $ticketModel;
    private $organizationModel;
    private $userModel;

    public function __construct(
        TicketModel $ticketModel,
        OrganizationModel $organizationModel,
        UserModel $userModel
    )
    {
        $this->ticketModel = $ticketModel;
        $this->organizationModel = $organizationModel;
        $this->userModel = $userModel;
    }

    public function getAllTickets()
    {
        $data = $this->ticketModel->getAllTickets();
        return $data;
    }

    public function getTicketsForOrganization($value)
    {
        $data = $this->ticketModel->getTicketsForOrganization($value);
        return $data;
    }

    public function getOrganizationsByFieldAndValue($field, $value)
    {
        $data = $this->organizationModel->getOrganizationsByFieldAndValue($field, $value);
        return $data;
    }

    public function getTicketsByFieldAndValue($field, $value)
    {
        $data = $this->ticketModel->getTicketsByFieldAndValue($field, $value);
        return $data;
    }

    public function getAllUsers()
    {
        $data = $this->userModel->getAllUsers();
        return $data;
    }

    public function getAllOrganizations()
    {
        $data = $this->organizationModel->getAllOrganizations();
        return $data;
    }

    /*public function searchByOrganization($arrInput)
    {
        //dd('ccc');
        $tickets = $this->ticketModel->getAllTickets();
        $organizations = $this->organizationModel->getAllOrganizations();
        $users = $this->userModel->getAllUsers();

        $filtered = $organizations->filter(function ($organization) use ($arrInput, $tickets, $users) {
            if (data_get($organization, $arrInput['field']) == $arrInput['val'] ) {
                $xx['organization_id'] = $organization['_id'];
                $xx['organization_name'] = $organization['name'];

                $organizationTickets = $tickets->filter(function ($ticket) use ($arrInput, $users) {
                    if (data_get($ticket, 'organization_id') == $arrInput['val'] ) {
                        $xx['tickets']['id'] = $ticket['_id'];
                        $xx['tickets']['subject'] = $ticket['subject'];

                        /*$user = $users
                            ->where($arrInput['field'], $ticket['submitter_id'])
                            ->all();

                        $xx['tickets']['username'] = $user['name'];*/
                       // return $xx;
                    //}
                //});
                //dd($organizationTickets);
                //$xx['tickets'] = $organizationTickets;
                //dd($xx);
                //return $xx;
            //}

        //});
//dd($filtered->all());
    //}*/
}
