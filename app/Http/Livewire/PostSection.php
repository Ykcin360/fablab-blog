<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class PostSection extends Component
{
    use WithPagination;

    public $categoryFilter;
    protected $posts;
    protected $categories;
    protected $sessionKey = 'category_filter';

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->categoryFilter = session($this->sessionKey, null);
    }

    /**
     * Reset the category filter.
     *
     * @return void
     */
    public function resetCategoryFilter(): void
    {
        $this->categoryFilter = null;
        session([$this->sessionKey => null]);
        $this->loadData();
    }

    /**
     * Filter posts by category ID.
     *
     * @param  int  $categoryId
     * @return void
     */
    public function filterByCategory(int $categoryId): void
    {
        $this->categoryFilter = $categoryId;
        session([$this->sessionKey => $this->categoryFilter]);
        $this->loadData();
    }

    /**
     * Load card data.
     *
     * @return void
     */
    public function loadCardData(): void
    {
        sleep(rand(0, 1));
        $this->loadData();
    }

    /**
     * Load the required data from database.
     *
     * @return 
     */
    public function loadData()
    {
        $postsQuery = Post::with('category:id,name', 'user:id,first_name,last_name')
            ->where('state_id', '1');

        if ($this->categoryFilter) {
            $postsQuery->where('category_id', $this->categoryFilter);
        }

        $this->posts = $postsQuery->latest()->paginate(4);
        $this->categories = Category::pluck('name', 'id');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): \Illuminate\View\View
    {
        return view('livewire.post-section', [
            'posts' => $this->posts,
            'categories' => $this->categories,
        ]);
        
    }
}