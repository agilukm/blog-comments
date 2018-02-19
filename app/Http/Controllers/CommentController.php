<?php 

namespace App\Http\Controllers;
 

use App\Services\Comment\Comment;
use App\Services\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller  {
 
    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    
    public function browse(Request $request)
    {        
        $filters = $request->only('filter','orfilter');

        $params = [
            'page' => [
                'limit' => $request->input('limit')
            ],
            'filter' => $filters
        ];
        $data = $this->service->browse($params);
        return response()->json($data);
    }

    public function read($id)
    {
        $data = $this->service->read($id);
        return response()->json($data);
    }

    public function read_by_post($id)
    {
        $data = $this->service->read_by_post($id);
        return response()->json($data);
    }
        
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.email' => 'required',
            'data.message' => 'required',
            'data.post_id' => 'required'
        ]);

        if ($this->service->edit($request->toArray(),$id)) {         
            return response()->json([
                'meta'      => [
                    'name' => $request->input('data.name'),
                    'email' => $request->input('data.email'),
                    'messages' => $request->input('data.message'),
                    'post_id' => $request->input('data.post_id'),
                    'website' => $request->input('data.website'),
                    'parent_id' => $request->input('data.parent_id')                    
                ],
                'message' => 'Successfull update post'
            ]);
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.email' => 'required',
            'data.message' => 'required',
            'data.post_id' => 'required'
        ]);
        if ($this->service->add($request->toArray())) {
            return response()->json([
                'meta'      => [
                    'name' => $request->input('data.name'),
                    'email' => $request->input('data.email'),
                    'messages' => $request->input('data.message'),
                    'post_id' => $request->input('data.post_id'),
                    'website' => $request->input('data.website'),
                    'parent_id' => $request->input('data.parent_id')                    
                ],
                'message'   => 'Successfull save post'
            ]);            
        }        
    }    

    public function delete(Request $request)
    {        
        $deletedCount = 0;
        $ids = collect($request->input("data"))->pluck("id")->toArray();

        if (count($ids)) {
            $deletedCount = $this->service->delete($ids);    
        }

        return response()->json([
                'meta' => [
                    'deleted_count' => $deletedCount
                ],
            ]);        
    } 
}

?>