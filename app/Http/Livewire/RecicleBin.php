<?php

namespace App\Http\Livewire;

use App\Models\ChMessage;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class RecicleBin extends Component
{
    use WithPagination;
    public string $selectedTable = '';
    protected $users;
    protected $posts;
    protected $comments;
    protected $messages;
    protected $sessionKey = 'selectedTable';

    public function mount()
    {
        $this->selectedTable = session($this->sessionKey, '');
    }

    // Showing Tables
    public function showUserTable()
    {
        $this->selectedTable = 'User';
        session([$this->sessionKey => $this->selectedTable]);
    }

    public function showPostTable()
    {
        $this->selectedTable = 'Post';
        session([$this->sessionKey => $this->selectedTable]);
    }

    public function showCommentTable()
    {
        $this->selectedTable = 'Comment';
        session([$this->sessionKey => $this->selectedTable]);
    }

    public function showMessageTable()
    {
        $this->selectedTable = 'Message';
        session([$this->sessionKey => $this->selectedTable]);
    }

    // Restoring Datas
    public function restoreUser(User $user)
    {
        $user->state_id = 1;
        $user->save();
    }

    public function restorePost(Post $post)
    {
        $post->state_id = 1;
        $post->save();
    }

    public function restoreComment(Comment $comment)
    {
        $comment->state_id = 1;
        $comment->save();
    }

    public function restoreMessage(ChMessage $message)
    {
        $message->state_id = 1;
        $message->save();
    }

    // Deleting Data Permanently
    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function deletePost(Post $post)
    {
        $post->delete();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
    }

    public function deleteMessage(ChMessage $message)
    {
        $message->delete();
    }

    public function render()
    {
        $this->users = User::where('state_id', '2')->paginate(8);
        $this->posts = Post::where('state_id', '2')->paginate(8);
        $this->comments = Comment::where('state_id', '2')->paginate(8);
        $this->messages = ChMessage::where('state_id', '2')->paginate(8);

        return view('livewire.recicle-bin', [
            'users' => $this->users,
            'posts' => $this->posts,
            'comments' => $this->comments,
            'messages' => $this->messages,
        ]);
    }
}
