<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserModel
 * @package App\Models
 */
class UserModel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    private $path ;
    private $userData;

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        $this->path = storage_path() . "/json/users.json";
        $this->userData = collect(json_decode(file_get_contents($this->path), true ));
    }

    /**
     * Get all users from the json file
     *
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->userData;
    }
}
