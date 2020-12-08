<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketModel
 * @package App\Models
 */
class TicketModel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    private $path;
    private $ticketData;

    /**
     * TicketModel constructor.
     */
    public function __construct()
    {
        $this->path = storage_path() . "/json/tickets.json";
        $this->ticketData = collect(json_decode(file_get_contents($this->path), true));
    }

    /**
     * Get all tickets from json file
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllTickets()
    {
        return $this->ticketData;
    }

    /**
     * Get tickets for the selected organization
     *
     * @param $value
     * @return array
     */
    public function getTicketsForOrganization($value)
    {
        return $this->ticketData
            ->where('organization_id', $value)
            ->all();
    }

    /**
     * Get tickets for the selected field and value
     *
     * @param $field
     * @param $value
     * @return array
     */
    public function getTicketsByFieldAndValue($field, $value)
    {
        return $this->ticketData
            ->where($field, $value)
            ->all();
    }
}
