<?php

namespace App\Repositories\Contracts;

interface TicketSearchRepositoryInterface
{

    public function getAllTickets();

    public function getTicketsForOrganization($value);

    public function getOrganizationsByFieldAndValue($field, $value);

    public function getTicketsByFieldAndValue($field, $value);

    public function getAllUsers();

    public function getAllOrganizations();

}
