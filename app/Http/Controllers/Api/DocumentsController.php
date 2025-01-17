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
            $filePath = null;
            if ($request->hasFile('file')) {
                // $filePath = $request->file('file')->store('documents', 'public');
                 // Store the file in the 'documents' directory within the 'public' disk
                $storedPath = $request->file('file')->store('documents', 'public');
                // Generate the full URL for the stored file
                $filePath = asset('storage/' . $storedPath);
                // return response()->json(['error' => 'No file uploaded'], 400);
            }
            $tagList = explode(',', $request->tags);
            $tags = Tag::whereIn('id', $tagList)->get();

            Log::info("content data: ". $request->content);
            $document = $user->document()->create([
                'title' => $request->title,
                'content' => $request->content,
                'path' => $filePath,
            ]);

            $document->tags()->attach($tags);
            return response()->json(['data' => $document],201);
            // return response()->json(['data' => new DocumentResource($document)], 201);
        } catch (\Exception $e) {
            // Log the exception and return a generic error response
            Log::error('Error creating document: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating document'], 500);
        }
    }


    function show(Document $document)
    {
        return response()->json(['data' => new DocumentResource($document)], 200);
    }
    // function update(Request $request, Document $document)
    // {

    //     try {
    //         $user = $request->user();
    //         $filePath = $document->path;
    //         $content = $document->content;
    //         $tags = $document->tags;
    //         if ($request->hasFile('file')) {
    //             $storedPath = $request->file('file')->store('documents', 'public');
    //             $filePath = asset('storage/' . $storedPath);
    //         }
    //         if($request->has) {}
    //         $tagList = explode(',', $request->tags);
    //         $tags = Tag::whereIn('id', $tagList)->get();
    //         $content = json_decode($request->content, true);
    //         $document->update([
    //             // 'title' => $temp['title'],
    //             'content' => $data['content']
    //         ]);
    //         // broadcast(new DocumentUpdated($user, $request->content));
    
    //         return response()->json(['message' => "update successful", 'data' => $document], 200);
    //     } catch (\Exception $e) {
    //         //throw $th;
    //          // Log the exception and return a generic error response
    //          Log::error('Error updating document: ' . $e->getMessage());
    //          return response()->json(['message' => 'Error creating document'], 500);
    //     }
      
    // }
    
    public function update(Request $request, Document $document)
{
    try {
        // Log the incoming request data for debugging
        Log::info("content data: ". $request->content);
        // Log::info('Received update request:', $request->title);
        
        // Prepare data for updating
        $updateData = [];

        // Handle file upload
        if ($request->hasFile('file')) {
            $storedPath = $request->file('file')->store('documents', 'public');
            $updateData['path'] = asset('storage/' . $storedPath);
        }

        // Handle content update
        if ($request->filled('content')) {
            $updateData['content'] = json_decode($request->input('content'), true);
            // Log::info("content json: ". $updateData['content']);
            // $updateData['content'] = $request->input('content');
        }

        // Handle title update
        if ($request->filled('title')) {
            $updateData['title'] = $request->input('title');
        }

        // Update tags if provided
        if ($request->filled('tags')) {
            $tagList = explode(',', $request->input('tags'));
            $tags = Tag::whereIn('id', $tagList)->get();
            $document->tags()->sync($tagList); // Sync tags for a many-to-many relationship
        }

        // Update the document
        $document->update($updateData);

        return response()->json(['message' => "Update successful", 'data' => $document], 200);
    } catch (\Exception $e) {
        // Log the exception and return a generic error response
        Log::error('Error updating document: ' . $e->getMessage());
        return response()->json(['message' => 'Error updating document'], 500);
    }
}

    function destroy(Document $document)
    {
        $document->delete();
        return response()->json(['message' => 'delete successful'], 200);
    }
}
