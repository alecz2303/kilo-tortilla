<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    public function getFullNameAttribute(){
        return "Nombre: {$this->nombre} {$this->ap_paterno} {$this->ap_materno} | IDMEX: {$this->idmex}";
    }

    public $additional_attributes = ['full_name'];
}
