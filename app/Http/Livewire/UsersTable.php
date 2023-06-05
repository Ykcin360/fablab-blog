<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    public string $search = '';

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->state_id = 2;
        $user->save();
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where('state_id', '1')
                ->where(function ($query) {
                $query  ->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
            })->paginate(5)
        ]);
    }
}
