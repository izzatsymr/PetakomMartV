<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffReport extends Model
{
    use HasFactory;
    
        protected $table = 'staffreports';
    
        protected $fillable = [
            'user_id',
            'start_time',
            'end_time',
            'opening_cash',
            'closing_cash',
            'short_cash',
            'created_at',
            'updated_at',
            
        ];
    
        // Define the relationships with other tables
        public function cashes()
        {
            return $this->belongsTo(Cash::class, 'sales_id');
        } 
        public function schedule()
        {
            return $this->belongsTo(Schedule::class, 'sales_id');
        } 
}
