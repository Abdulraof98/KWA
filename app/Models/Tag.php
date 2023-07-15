<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['tag', 'count','status', 'created_at', 'updated_at'];

    public function getName($str)
    {
        $ids = explode(',',$str);
        $tags = $this->select('tag')->whereIn('id',$ids)->get();
        $result = [];
        if ($tags->count()) {
            foreach($tags as $t){
                $result[] = $t->tag;
            }
        }
        return $result;
    }
}
