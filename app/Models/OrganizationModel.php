<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganizationModel
 * @package App\Models
 */
class OrganizationModel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    private $path;
    private $organizationData;

    /**
     * OrganizationModel constructor.
     */
    public function __construct()
    {
        $this->path = storage_path() . "/json/organizations.json";
        $this->organizationData = collect(json_decode(file_get_contents($this->path), true));
    }

    /**
     * Get all organizations from json
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllOrganizations()
    {
        return $this->organizationData;
    }

    /**
     * Get organization data for selected field and value
     *
     * @param $field
     * @param $value
     * @return array
     */
    public function getOrganizationsByFieldAndValue($field, $value)
    {
        return $this->organizationData->where($field, $value)->all();
    }
}
