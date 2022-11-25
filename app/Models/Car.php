<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    protected $hidden = ['updated_at'];

    protected $visible = ['name', 'founded', 'description'];

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    // Define a has many through relationship
    public function engines() {
        // Foreign key on CarModel table (car_id)
        // Foreign key on Engine table (model_id) 
        return $this->hasManyThrough(Engine::class, CarModel::class, 'car_id', 'model_id');
    }

    // Define a has one through relationship
    public function productionDate() {
        return $this->hasOneThrough(CarProductionDate::class, CarModel::class, 'car_id', 'model_id');
    }

    // Define a belongs to many relationship
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
