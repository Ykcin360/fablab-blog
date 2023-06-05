<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class PostSearch extends Component
{
    use WithPagination;
    public $search;
    protected $posts;

    public function mount(Request $request)
    {
        $this->search = $request->q;
    }

    public function loadData()
    {
        sleep(rand(0, 2));
        if ($this->search != '') {
            $this->posts = Post::where('state_id', '1')
                ->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                })->paginate(6);
        }
    }

    public function render()
    {
        // $this->loadData();
        return view('livewire.post-search', [
            'q' => $this->search,
            'posts' => $this->posts
        ]);
    }
}
