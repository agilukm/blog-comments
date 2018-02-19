<?php 
namespace App\Services\Comment;
use App\Services\Comment\Comment;


class Filter {
 
    private $repository;
    private $allowedOperators = [
            'eq' => '=',
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'like' => 'Like',
            'notlike' => 'Not Like',
            'notin' => 'NotIn',
            'in' => 'In',
        ];

    public function __construct(Comment $repository)
    {
        $this->comment = $repository;

    }

   
    function filtering($query)
    {
        $appends = [];
        $appends['limit'] = $query['page']['limit'];
        foreach ($query['filter'] as $filter => $value) {
            return $this->parse($value,$appends);
        }
    }

    public function parse($value,$appends)
    {                                       
        foreach ($value as $field => $value_field) {
            foreach ($value_field as $key => $keyword) {
                $appends['filter'][$field][$key] = $keyword;                    
                return $this->query($field,$key,$keyword,$appends);
            }
        }
    }

    function query($field,$key,$keyword,$appends)
    {        
        

        if ($key == 'like' || $key == 'notlike') {
            $comment = $this->comment->where($field,$this->allowedOperators[$key],'%'.$keyword.'%');                        
        }

        elseif($key == 'is') {
            $comment = $this->comment->where($field,$keyword);
        }       
    
        else {
            $comment = $this->comment->where($field,$this->allowedOperators[$key],$keyword);
        }

        return $comment->with('meta')->paginate($query['page']['limit']??20)->appends($appends);
    }

 
}