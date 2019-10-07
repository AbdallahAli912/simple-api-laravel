<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Http\Response;



class PostController extends Controller
{
    use ApiResponseTrait;

   Public function index()
   {
       $posts= PostResource::collection( Post::paginate($this->paginateNumber));
       return  $this-> apiResponse ($posts);
   }

   public function show($id)
   {
       $post= Post::find($id);;
       if($post)
       {
           $this->successResponse($post);
       }
       else
       {
          return $this->notFoundResponse();
       }
   }


    public function delete($id)
    {
        $post= Post::find($id);
        if($post)
        {
            $post->delete();
           return  $this->deletedResponse();
        }
        else
        {
            return $this->notFoundResponse();
        }
    }



    public function store(Request $request)
   {
       $validation= $this->validation($request);
       if($validation instanceOf Response)
       {
           return $validation;
       }


       $post=Post::create($request->all());
       if($post)
       {
          return $this->createdResponse(new PostResource($post));
       }
       return $this->unknownErrorResponse();

   }


   public function update(Request $request,$id)
   {


      $validation= $this->validation($request);
      if($validation instanceOf Response)
      {
          return $validation;
      }

       $post= Post::find($id);
       if(!$post)
       {
           return $this->notFoundResponse();
       }

       $post->update($request->all());
       if($post)
       {
        return   $this->successResponse($post);
       }
      $this->unknownErrorResponse();
   }

   public function validation($request)
   {
       return  $this->apiValidation($request,[
           'title'=>'required|min:3|max:191',
           'body'=>'required',
       ]);
   }

    public function successResponse($post)
    {
        return $this->apiResponse( new  PostResource( $post));
    }

}
