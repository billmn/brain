<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (ends_with($key, '_tz') and in_array(substr($key, 0, -3), $this->getDates())) {
            return $this->getAttributeValue(substr($key, 0, -3))->timezone(settings('timezone'));
        }

        return parent::getAttribute($key);
    }
}
