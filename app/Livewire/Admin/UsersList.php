<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $confirming = null;

    protected $listeners = ['userSaved' => 'render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $this->confirming = null;
        session()->flash('message', 'تم حذف المستخدم');
    }

    public function render()
    {
        $users = User::where(function ($q) {
            $q->where('name', 'like', "%{$this->search}%")
              ->orWhere('email', 'like', "%{$this->search}%");
        })->latest()->paginate($this->perPage);

        return view('livewire.admin.users-list', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }
}
