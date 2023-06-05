<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentSection extends Component
{

    use WithPagination;
    public $postId;
    public $perPage = 5;
    public $content;
    public $editingCommentId;
    public $updatingContent;
    public $newContent;

    protected $rules = [
        'newContent' => 'sometimes'
    ];

    public function addComment()
    {
        // Création de notre commentaire avec le contenu
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->postId,
            'content' => $this->content,
        ]);

        // Réinitialiser le champs de saisie
        $this->reset(['content']);
    }

    public function editComment($commentId)
    {
        $this->editingCommentId = $commentId;
        $this->newContent = Comment::find($commentId)->content;
    }

    public function cancelEdit(){
        $this->editingCommentId = null;
    }

    public function updateComment()
    {
        if (!empty($this->editingCommentId)) {
            $commentToUpdate = Comment::find($this->editingCommentId);
            $commentToUpdate->content = $this->newContent;
            $commentToUpdate->save();
        
            // Réinitialisation des champs de saisie et id pour la modification ultérieure
            $this->reset(['editingCommentId', 'updatingContent']);
        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->state_id = 2;
        $comment->save();
    } 

    public function render()
    {

        $post = Post::with('comments')->find($this->postId);
        $comments = $post->comments->sortByDesc('id')->where('state_id', '1');

        $page = LengthAwarePaginator::resolveCurrentPage();
        $sliced = collect($comments)->slice(($page - 1) * $this->perPage, $this->perPage);
        $paginator = new LengthAwarePaginator($sliced, count($comments), $this->perPage);
        $paginator->withPath(route('posts.show', ['post' => $post, 'page' => $page]));

        return view('livewire.comment-section', [
            'post' => $post,
            'comments' => $paginator
        ]);
    }
}
