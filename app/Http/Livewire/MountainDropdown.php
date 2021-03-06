<?php
namespace App\Http\Livewire;

use App\Models\Mountain;
use Illuminate\Support\Collection;
use Livewire\Component;

class MountainDropdown extends Component
{
    // search when there are this many characters or more
    const MIN_SEARCH_STRLEN = 3;

    public string $search = '';

    public function render()
    {
        $mountains = $this->getMountains();

        return view('livewire.mountain-dropdown', [
            'mountains' => $mountains
        ]);
    }

    private function getMountains(): Collection
    {
        if (strlen($this->search) < self::MIN_SEARCH_STRLEN) {
            return Mountain::active()->orderBy('name')->orderBy('region_3')->get();
        } else {
            $expression = "%{$this->search}%";

            return Mountain::active()
                ->where('name', 'like', $expression)
                ->orWhere('short_name', 'like', $expression)
                ->orderBy('name')
                ->orderBy('region_3')
                ->get();
        }
    }
}