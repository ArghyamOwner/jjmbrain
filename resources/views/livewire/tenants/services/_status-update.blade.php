<livewire:tenants.services.status-update 
	:service-id="$service->id" 
	:status="$service->status" 
	wire:key="service-{{ $service->id }}" 
/>