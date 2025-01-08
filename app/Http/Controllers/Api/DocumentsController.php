<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentsController extends Controller
{
    function index()
    {

        try {
            $documents = Document::get();
            return DocumentResource::collection($documents);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return response()->json(["message" => "error fetching data try again later"], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Get the authenticated user
            $user = $request->user();
            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'No file uploaded'], 400);
            }

            $filePath = $request->file('file')->store('documents', 'public');

            $tags = Tag::whereIn('id', [$request->tags])->get();

            $document = $user->document()->create([
                'title' => $request->title,
                'content' => $request->content,
                'path' => $filePath,
            ]);

            $document->tags()->attach($tags);
            return response()->json(['data: ' => $document],201);
            // return response()->json(['data' => new DocumentResource($document)], 201);
        } catch (\Exception $e) {
            // Log the exception and return a generic error response
            Log::error('Error creating document: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating document'], 500);
        }
    }


    function show(Document $document)
    {
        return response()->json(['data' => $document], 200);
    }
    function update(Request $request, Document $document)
    {
        $document->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => "update successful", 'data' => $document], 200);
    }
    function destroy(Document $document)
    {
        $document->delete();
        return response()->json(['message' => 'delete successful'], 200);
    }
}
