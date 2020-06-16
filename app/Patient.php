<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Patient extends Model
{

    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'first_name' => 11,
            'name' => 10,
            'last_name' => 9,
        ]
    ];

    protected $fillable = [
        'name', 'first_name', 'birthday','last_name','phone', 'card_name', 'gender', 'doctor_id'
    ];

    public function where_my()
    {
        return $this->hasOne(Where::class, 'id', 'where_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function doctor()
	{
		return $this->hasOne(User::class, 'id', 'doctor_id');
	}

	public function fullName()
	{
		return $this->first_name . ' ' . $this->name . ' ' . $this->last_name;
	}

}
