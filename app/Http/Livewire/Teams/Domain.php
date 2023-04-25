<?php

namespace App\Http\Livewire\Teams;

use Livewire\Component;

class Domain extends Component
{
    protected $team;

    public function mount($team)
    {
        $this->team = $team;
    }

    public function updateDomain()
    {
        $this->validate([
            'team.domain' => 'required|alpha_dash|unique:teams,domain,' . $this->team->id,
        ]);

        $this->team->forceFill([
            'domain' => $this->team->domain,
        ])->save();

        session()->flash('flash.banner', 'Team domain updated successfully.');
        session()->flash('flash.bannerStyle', 'success');
    }

    public function render()
    {
        return view('livewire.teams.domain');
    }
}
