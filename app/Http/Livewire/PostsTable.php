<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
{
    use WithPagination;
    public string $search = '';

    public function deletePost($postId, $categoryId)
    {
        $post = Post::find($postId);
        $post->category_id = $categoryId;
        $post->state_id = 2;
        $post->save();
    }

    public function render()
    {
        return view('livewire.posts-table', [
            'posts' => Post::where('state_id', '1')
                ->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })->paginate(5)
        ]);
    }
}