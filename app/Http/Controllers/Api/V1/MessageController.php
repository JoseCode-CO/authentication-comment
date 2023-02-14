<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = $this->messageRepository->getAll();
            return response(["posts" => $posts], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al listar los Menssages", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $post = $this->messageRepository->create($request);
            return response(["post" => $post], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al crear el Mensaje", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = $this->messageRepository->findById($id);
            return response(["post" => $post], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al listar el Mensaje", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->validated();
        try {
            $post = $this->messageRepository->update($attributes, $id);
            return response(["post" => $post], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al listar el Mensaje", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = $this->messageRepository->delete($id);
            return response(["post" => $post], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return  response([
                "message" => "Algo salio mal al eliminar el Mensaje", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
