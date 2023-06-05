<?php

namespace App\Http\Livewire;

use App\Models\Gender;
use Livewire\Component;

class GenderManager extends Component
{
    public $genders;
    public $name;
    public $newGenderName;
    public $editingGenderId;

    public function mount()
    {
        $this->genders = Gender::all();
    }

    protected $rules = [
        'name' => 'required|min:2',
        // 'newGenderName' => 'sometimes'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cancelEdit()
    {
        $this->editingGenderId = null;
    }

    public function addGender()
    {
        $validatedData = $this->validate();

        $newGender = Gender::create($validatedData);

        $this->genders->push($newGender);

        $this->name = '';
    }

    public function editGender($id)
    {
        // Marquer l'ID de le genre comme étant en train d'être édité
        $this->editingGenderId = $id;

        // Récupérer le nom de le genre et le mettre dans le champ de texte pour l'édition
        $this->newGenderName = Gender::find($id)->name;
    }

    public function updateGender()
    {
        // Mettre à jour le nom de le genre sélectionnée avec la nouvelle valeur
        if ($this->editingGenderId != null) {
            $GenderToUpdate = Gender::find($this->editingGenderId);
            $GenderToUpdate->name = $this->newGenderName;
            $GenderToUpdate->save();
        }

        // Réinitialiser les variables utilisées pour l'édition de catégorie
        $this->editingGenderId = null;
        $this->newGenderName = '';

        // Mettre à jour la liste des catégories
        $this->genders = Gender::all();
    }

    public function deleteGender($id)
    {
        // Récupérer le genre avec l'ID donné
        $Gender = Gender::find($id);

        // Vérifier s'il y a des utilisateurs associés au genre
        if ($Gender->users()->count() > 0) {
            session()->flash('error', 'This Gender is associated with some users and can\'t be deleted.');
            return;
        }

        // Supprimer le genre avec l'ID donné
        Gender::destroy($id);

        // Mettre à jour la liste des catégories
        $this->genders = Gender::all();
    }
}