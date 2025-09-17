<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class MetaSetting extends Model implements TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['name', 'banner'];
    public $translatedAttributes = ['meta_title', 'meta_des'];
    public $translationForeignKey = 'meta_setting_id';
    public $translationModel = 'App\Models\Api\Admin\MetaSettingTranslation';

    protected function serializeDate(\DateTimeInterface $date)
    {
      return $date->format('Y-m-d'); 
    }


    
}