<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesReport extends Model
{
    
        use HasFactory;
    
        protected $table = 'salesreports';
    
        protected $fillable = [
            'Sales_id',
            'subtotal_sales',
            'service_tax',
            'total_sales',
            'status',
            'refunded_reason',
            'created_at',
            'updated_at',
            
        ];
    
        // Define the relationships with other tables
        public function sales()
        {
            return $this->belongsTo(Sale::class, 'sales_id');
        } 
}
