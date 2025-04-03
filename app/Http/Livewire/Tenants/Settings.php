<?php

namespace App\Http\Livewire\Tenants;

use App\Models\Setting;
use App\Rules\CheckValidLatitude;
use App\Rules\CheckValidLongitude;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $metaTitle;
    public $metaDescription;
    public $address;
    public $email;
    public $phone;
    public $socialLinks = [];
    public $metrics = [];
    public $latitude;
    public $longitude;
    public $logo;
    public $logoUrl;
    public $officeHours;

    public function mount()
    {
        $setting = $this->setting;

        if ($setting) {
            $this->metaTitle = $setting->meta_title;
            $this->metaDescription = $setting->meta_description;
            $this->address = $setting->address;
            $this->email = $setting->contact_email;
            $this->phone = $setting->contact_phone;
            $this->socialLinks = $setting->social_links;
            $this->metrics = $setting->metrics;
            $this->latitude = $setting->latitude;
            $this->longitude = $setting->longitude;
            $this->officeHours = $setting->working_hours;
            $this->logoUrl = $setting->logo_url;
        }
    }

    public function getSettingProperty()
    {
        return Setting::first();
    }

    public function saveSettings()
    {
        $validated = $this->validate([
            'logo' => ['nullable', 'image', 'max:1024'],
            'metaTitle' => ['required', 'string'],
            'metaDescription' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'email'],
            'phone' => ['nullable', 'string', 'digits:10'],
            'socialLinks' => ['nullable', 'array', 'max:3'],
            'metrics' => ['nullable', 'array', 'max:4'],
            'latitude' => ['nullable', new CheckValidLatitude],
            'longitude' => ['nullable', new CheckValidLongitude],
            'officeHours' => ['nullable'],
        ]);
        
        $setting = Setting::updateOrCreate(
            [
                'id' => $this->setting->id ?? null,
                'tenant_id' => session('tenant_id'),
            ],
            [
                'meta_title' => $validated['metaTitle'],
                'meta_description' => $validated['metaDescription'],
                'address' => $validated['address'],
                'contact_email' => $validated['email'],
                'contact_phone' => $validated['phone'],
                'social_links' => $validated['socialLinks'],
                'metrics' => $validated['metrics'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'working_hours' => $validated['officeHours'],
            ]
        );

        if ($this->logo) {
            $setting->update([
                'logo' => $this->logo->store('/', 'public')
            ]);
        }

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->logoUrl = $setting->logo_url;

        $this->notify('Settings saved.');
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.tenants.settings');
    }
}
