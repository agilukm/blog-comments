<?php 

namespace App\Services\Comment;

class CommentService
{

	private $repository;

	public function __construct(Comment $repository)
	{
		$this->comment = $repository;

	}

	public function browse($query = [])
	{			
		$out = $this->comment->get();	
						

		foreach ($out as $key => $value) {
			$message = '';
			foreach (Comment::where('parent_id',$value->id)->select('id')->get() as $key => $parent) {
				$message[] = 	array("id" => $parent->id, );
			}

			$data[] = array(
					'id' 			=> $value->id, 
					'type' 			=> 'comments',
					'post_id' 		=> $value->post_id,
					"attributes"	=> array(
							"name"		=> $value->name,	
							"website"	=> $value->website,	
							"email"		=> $value->email,	
							"message"	=> $value->message,
							"created"	=> $value->created_at,
					),
					"relationships" => !empty($message)? array("comments"=>$message):''				
			);			
		}

		return $data;
	}

	public function read($id)
	{
		return $this->comment->find($id);
	}
	public function read_by_post($id)
	{
		return $this->comment->where('post_id',$id)->get();
	}

	public function edit($attributes,$id)
	{
		$comment = $this->read($id);
		$comment->fill($attributes['data']);
		$comment->save();
		return $comment;
	}

	public function add($attributes = [])
	{
		$comment = $this->comment->fill($attributes['data']);
		$comment->save();
		return $comment;
	}

	public function delete($ids = [])
	{
		$deleted = $this->comment->destroy($ids);
		return $deleted;
	}

}