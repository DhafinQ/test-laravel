<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;
   
class ArticleAPIController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $Articles = Article::all();
    
        return $this->sendResponse(ArticleResource::collection($Articles), 'Articles retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Article = Article::create($input);
   
        return $this->sendResponse(new ArticleResource($Article), 'Article created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $Article = Article::find($id);
  
        if (is_null($Article)) {
            return $this->sendError('Article not found.');
        }
   
        return $this->sendResponse(new ArticleResource($Article), 'Article retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $Article): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Article->title = $input['title'];
        $Article->content = $input['content'];
        $Article->category_id = $input['category_id'];
        $Article->user_id = $input['user_id'];
        $Article->save();
   
        return $this->sendResponse(new ArticleResource($Article), 'Article updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $Article): JsonResponse
    {
        $Article->delete();
   
        return $this->sendResponse([], 'Article deleted successfully.');
    }
}