<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class PostReaction extends Component
{
    public $postId;
    public $post;
    public $isLikeReacted;
    public $isHeartReacted;
    public $isFireReacted;

    public function mount($postId)
    {
        $this->post = Post::find($postId);

        // Vérifier si l'utilisateur a déjà réagi à ce post
        $existingReaction = Reaction::where('user_id', Auth::id())
            ->where('post_id', $this->post->id)
            ->first();

        // Définir les valeurs booléennes en fonction de la sélection de l'utilisateur
        if ($existingReaction) {
            switch ($existingReaction->type) {
                case 'like':
                    $this->isLikeReacted = true;
                    break;
                case 'heart':
                    $this->isHeartReacted = true;
                    break;
                case 'fire':
                    $this->isFireReacted = true;
                    break;
            }
        }
    }

    public function react($type)
    {
        // Vérifier si l'utilisateur a déjà réagi à ce post
        $existingReaction = Reaction::where('user_id', Auth::id())
            ->where('post_id', $this->post->id)
            ->first();

        // Si l'utilisateur a déjà réagi, mettre à jour la réaction existante
        if ($existingReaction) {
            $existingReaction->type = $type;
            $existingReaction->save();

            $this->isLikeReacted = false;
            $this->isHeartReacted = false;
            $this->isFireReacted = false;
            switch ($existingReaction->type) {
                case 'like':
                    $this->isLikeReacted = true;
                    break;
                case 'heart':
                    $this->isHeartReacted = true;
                    break;
                case 'fire':
                    $this->isFireReacted = true;
                    break;
            }
        }
        // Sinon, créer une nouvelle réaction
        else {
            $newReaction = new Reaction;
            $newReaction->user_id = Auth::id();
            $newReaction->post_id = $this->post->id;
            $newReaction->type = $type;
            $newReaction->save();
            
            $this->isLikeReacted = false;
            $this->isHeartReacted = false;
            $this->isFireReacted = false;
            switch ($newReaction->type) {
                case 'like':
                    $this->isLikeReacted = true;
                    break;
                case 'heart':
                    $this->isHeartReacted = true;
                    break;
                case 'fire':
                    $this->isFireReacted = true;
                    break;
            }
        }
    }

    public function unreact()
    {
        // Trouver la réaction de l'utilisateur pour ce post et la supprimer
        $existingReaction = Reaction::where('user_id', Auth::id())
            ->where('post_id', $this->post->id)
            ->first();

        if ($existingReaction) {
            $existingReaction->delete();
            
            if($this->isLikeReacted){
                $this->isLikeReacted = false;
            }elseif($this->isHeartReacted){
                $this->isHeartReacted = false;
            }elseif($this->isFireReacted){
                $this->isFireReacted = false;
            }
        }
    }

    public function getReactionCount($type)
    {
        return Reaction::where('post_id', $this->post->id)
            ->where('type', $type)
            ->count();
    }

    public function render()
    {
        return view('livewire.post-reaction');
    }
}