<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CategoryManager extends Component
{
    public $categories;
    public $name;
    public $newCategoryName;
    public $editingCategoryId;

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected $rules = [
        'name' => 'required|min:2',
        // 'newCategoryName' => 'sometimes'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cancelEdit(){
        $this->editingCategoryId = null;
    }
    
    public function addCategory()
    {
        $validatedData = $this->validate();

        $newCategory = Category::create($validatedData);

        $this->categories->push($newCategory);

        $this->name = '';
    }

    public function editCategory($id)
    {
        // Marquer l'ID de la catégorie comme étant en train d'être édité
        $this->editingCategoryId = $id;

        // Récupérer le nom de la catégorie et le mettre dans le champ de texte pour l'édition
        $this->newCategoryName = Category::find($id)->name;
    }

    public function updateCategory()
    {
        // Mettre à jour le nom de la catégorie sélectionnée avec la nouvelle valeur
        if($this->editingCategoryId != null){
            $categoryToUpdate = Category::find($this->editingCategoryId);
            $categoryToUpdate->name = $this->newCategoryName;
            $categoryToUpdate->save();
        }

        // Réinitialiser les variables utilisées pour l'édition de catégorie
        $this->editingCategoryId = null;
        $this->newCategoryName = '';

        // Mettre à jour la liste des catégories
        $this->categories = Category::all();
    }

    public function deleteCategory($id)
    {
        // Récupérer la catégorie avec l'ID donné
        $category = Category::find($id);

        // Vérifier s'il y a des posts associés à la catégorie
        if ($category->posts()->count() > 0) {
            session()->flash('error', 'This category is associated with some posts and can\'t be deleted.');
            return;
        }

        // Supprimer la catégorie avec l'ID donné
        Category::destroy($id);

        // Mettre à jour la liste des catégories
        $this->categories = Category::all();
    }
}
