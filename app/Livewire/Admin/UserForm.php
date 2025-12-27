<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $roles = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->userId ? ",$this->userId" : ''),
            'password' => $this->userId ? 'nullable|min:8' : 'required|min:8',
            'roles' => 'array',
        ];
    }

    public function mount($userId = null)
    {
        if ($userId) {
            $user = User::findOrFail($userId);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->roles = $user->roles()->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            if ($this->password) {
                $user->password = Hash::make($this->password);
                $user->save();
            }
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $this->userId = $user->id;
        }

        // sync roles
        $user->syncRoles($this->roles ?: []);

        $this->emit('userSaved');
        session()->flash('message', 'تم حفظ المستخدم');
        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.user-form', [
            'roles' => Role::all(),
        ]);
    }
}
