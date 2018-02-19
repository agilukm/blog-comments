<?php 
namespace App\Services\Comment;
use Illuminate\Database\Eloquent\Model;
 
class Comment extends Model {
 
    protected $fillable = ['name','email','website','message','parent_id','post_id'];
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'message' => 'required',
        'post_id' => 'required'
    ];
    public function parent()
    {
        return $this->belongsTo(\App\Services\Comment\Comment::class, 'parent_id');
    }
    public function child()
    {
        return $this->hasMany(\App\Services\Comment\Comment::class, 'id','parent_id')->select('id');
    }
 
}
?>