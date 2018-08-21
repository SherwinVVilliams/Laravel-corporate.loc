<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    
    public function filter(){
    	return $this->belongsTo('Corp\Filter', 'filter_alias', 'alias');//реалізуєм звязок з моделю Filter і з її полем alias
    }
}
