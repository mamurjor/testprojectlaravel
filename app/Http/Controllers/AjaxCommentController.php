<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class AjaxCommentController extends Controller
{
    // GET /blog/{post}/comments  -> JSON list (approved)
    public function index(Post $post, Request $request)
    {
        // nested tree বানাতে চাইলে children সহ নিন
        $comments = Comment::approved()
            ->where('post_id', $post->id)
            ->whereNull('parent_id')              // শুধু টপ-লেভেল, নিচে children পাঠাবো
            ->latest()
            ->paginate(10);

        // eager load children (one level) - চাইলে recursive resource করতে পারেন
        $comments->load(['children' => function($q) {
            $q->approved()->latest();
        }]);

        // API response
        return response()->json([
            'data' => $comments->map(function($c){
                return $this->serializeComment($c);
            }),
            'pagination' => [
                'current_page' => $comments->currentPage(),
                'last_page'    => $comments->lastPage(),
                'next_page_url'=> $comments->nextPageUrl(),
            ]
        ]);
    }

    // POST /blog/{post}/comments  -> JSON create
    public function store(Request $request, Post $post)
    {
        // Honeypot (optional)
        if ($request->filled('hp_field')) {
            return response()->json(['message' => 'ok'], 200);
        }

        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'website'   => 'nullable|url|max:200',
            'body'      => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $data['post_id']    = $post->id;
        $data['ip']         = $request->ip();
        $data['user_agent'] = substr((string)$request->userAgent(), 0, 255);
        $data['status']     = 'approved'; // চাইলে 'pending'

        $comment = Comment::create($data);

        // Return fresh with children relation
        $comment->load('children');

        return response()->json([
            'message' => 'Comment posted',
            'comment' => $this->serializeComment($comment)
        ], 201);
    }

    private function serializeComment(Comment $c): array
    {
        return [
            'id'         => $c->id,
            'name'       => $c->name,
            'email'      => $c->email,
            'website'    => $c->website,
            'body'       => nl2br(e($c->body)),
            'created_at' => $c->created_at->format('M d, Y H:i'),
            'parent_id'  => $c->parent_id,
            'children'   => $c->children->map(function($ch){
                return [
                    'id'         => $ch->id,
                    'name'       => $ch->name,
                    'email'      => $ch->email,
                    'website'    => $ch->website,
                    'body'       => nl2br(e($ch->body)),
                    'created_at' => $ch->created_at->format('M d, Y H:i'),
                    'parent_id'  => $ch->parent_id,
                ];
            }),
        ];
    }
}

