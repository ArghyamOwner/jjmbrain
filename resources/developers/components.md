### Button

```html
<x-button
	color="black"
	with-spinner
	wire:target="save"
>Save</x-button>
```

### Button Icon

```html
<x-button-icon>
	{{-- Put your icon or svg here --}}
	<x-icon-arrow-right-2 class="w-5 h-5" />
</x-button-icon>
```

### Text Input

```html
<x-input
	label="Name" 
	name="name"
	wire:model.defer="name" 
/>
```

### Radio Input

```html
<div class="mb-5">
	<x-label for="gender" class="mb-1">Gender</x-label>
	<div class="space-y-2">
		<x-radio 
			label="Male" 
			id="Male" 
			name="gender" 
			value="male"
			wire:model.defer="gender"
		/>
		<x-radio 
			label="Female" 
			id="Female" 
			name="gender" 
			value="female"
			wire:model.defer="gender"
		/>
	</div>
	<x-input-error for="gender" class="mt-1"/>
</div>
```

### Phone Number

```html
<x-input-number
	label="Phone" 
	id="phone" 
	name="phone" 
	wire:model.defer="phone"
	maxlength="10"
	minlength="10"
/>
```

### Select Input

```html
<x-select label="Role" name="role" wire:model.defer="role">
	<option value="" disabled selected>Select a role</option>
	<option value="Option 1">Option 1</option>
	<option value="Option 2">Option 2</option>
</x-select>
```

### Checkbox

```html
<x-checkbox
	label="Allow Notification" 
	id="allow-notification"
	wire:model.defer="allowNotification"
/>
```

### Password Input

```html
 <x-input-password
	label="New Password" 
	name="password" 
	wire:model.defer="password"
	hint="Must be atleast 8 characters."
/>
```

### Textarea

```html
<x-textarea
    label="Message"
    name="message"
    wire:model.defer="message"
/>
```

### Numeric Input

```html
<x-cleavejs
	label="Max Quantity" 
	id="quantity" 
	name="quantity" 
	wire:model.defer="quantity"
	hint="eg. 40"
	:options="[
		'numeral' => true,
		'numeralDecimalMark' => '',
		'delimiter' => ''
	]"
/>
```

### Native Datepicker

```html
<x-input
	type="date"
	label="DOB" 
	id="dob" 
	name="dob" 
	wire:model.defer="dob"
/>
```

### Phone Number Input

```html
<x-cleavejs 
	type="tel"
	label="Phone" 
	id="phone" 
	name="phone" 
	wire:model.defer="phone"
	hint="Enter a valid 10 digit mobile number"
	pattern="[9876]{1}[0-9]{9}"
	:options="[
		'blocks' => [10],
		'numericOnly' => true
	]"
/>
```

### Listbox

```html
<x-listbox
	label="Select Users"
	wire:model="selectedusers" 
	placeholder="select users to send notice"
	name="selectedusers" 
	id="selectedusers"
	:options="$users"
	multiple
/>
```

### Latitude Longitude

```html
<div class="mb-5">
	<div class="md:flex md:space-x-4">
		<div class="md:w-1/2">
			<x-input
				label="Latitude"
				id="latitude"
				name="latitude"             
				wire:model="latitude"
				readonly
				optional
			/>
		</div>

		<div class="md:w-1/2">
			<x-input
				label="Longitude"
				id="longitude"
				name="longitude"       
				wire:model="longitude"
				readonly
				optional
			/>
		</div>
	</div>
 
	<div wire:ignore class="mb-4">
		<div id="mapid" class="rounded-md overflow-hidden"></div>
	</div>
</div>

@once
	@push('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
	integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
	crossorigin=""/>
	<style>#mapid { height: 300px; }</style>
	@endpush

	@push('scripts')
		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
			integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
			crossorigin=""></script>
		<script>
			document.addEventListener('livewire:load', function () {
                var mapCenter = [{{ $latitude ?? config('custom.lat') }}, {{ $longitude ?? config('custom.lng') }}];
                var map = L.map('mapid').setView(mapCenter, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var marker = L.marker(mapCenter).addTo(map);
                
                function updateMarker(lat, lng) {
                    marker.setLatLng([lat, lng])
                        .bindPopup("Your location :  " + marker.getLatLng().toString())
                        .openPopup();
                    return false;
                };

                map.on('click', function(e) {
                    let latitude = e.latlng.lat.toString().substring(0, 11);
                    let longitude = e.latlng.lng.toString().substring(0, 11);

                    @this.set('latitude', latitude);
                    @this.set('longitude', longitude);

                    updateMarker(latitude, longitude);
                });

                var updateMarkerByInputs = function() {
                    return updateMarker(@this.get('latitude'), @this.get('longitude'));
                }

                document.getElementById('latitude').addEventListener("input", updateMarkerByInputs);
                document.getElementById('longitude').addEventListener("input", updateMarkerByInputs);
            });
		</script>
	@endpush
@endonce
```

### Search Input

```html
<x-input-search
    name="search"
    wire:model="search"
    placeholder="Search..."
/>
```

### Flash Message

```html
// inside your livewire method

$this->notify('Post saved', 'success');
$this->notify('Post saved', 'notice');
$this->notify('Post saved', 'error');
```

### Banner Message

```html
// inside your livewire method

$this->bannerMessage('Post created successfully.', 'success');
$this->bannerMessage('Something went wrong.', 'danger');
```

### Heading

```html
<x-heading 
	size="md|lg|xl|2xl|3xl|4xl"
>Your Heading Here...</x-heading>
```

### Badge

```html
<x-badge 
	variant="info|success|warning|danger|gray"
>Processing</x-badge>
```

### Breadcrumb

```html
<x-breadcrumb>
	<x-breadcrumb-item href="{{ route('roles') }}">Roles</x-breadcrumb-item>
	<x-breadcrumb-item>{{ Str::title($role->name) }}</x-breadcrumb-item>
</x-breadcrumb>
```

### FilePond

```html
<x-filepond
    label="Document Upload"
    name="document"
    wire:model="document"
/>
```

### Masked Input

```html
<x-cleave
    label="Amount"
    name="amount"
    append-before="&#8377;"
    :options="
        'numeral' => true, 
        'numeralThousandsGroupStyle' => 'lakh'
    ]"
    class="pl-8"
/>
```

### Alertbox

```html
<x-alertbox
	variant="info|success|warning|error"
>Your alert message goes here...</x-alertbox>
```

### Uploader

```html
<x-uploader
    label="Document Upload"
    name="document"
    wire:model="document"
	accept="images" // pdf/document/excel/csv
/>
```

### Quilljs Editor

```html
<x-quilljs-editor 
	label="Content"
	class="bg-white rounded-lg" 
	wire:model.defer="description" 
	// :initial-value="$description" // for edit
	name="description"
	height="300px" 
	placeholder-image-for-upload-progress="{{ url('placeholder-image.png') }}"
	toolbar-type="minimal" // default: normal
/>
```

### Tags Input

```html
 <x-input-tags 
	label="Tags"
	id="tags"
	name="tags"
	placeholder="eg. Technology, Life, Story"
	wire:model="tags"
	hint="Enter you tag and hit enter to add one or more tags."
	autocomplete="off"
/>
```

### File Input

```html
<x-input-file 
	label="Photo" 
	name="photo" 
	wire:model="photo" 
	:file="$photo" 
	accept="images" 
/>
```

### Lightbox

```html
<x-lightbox class="grid grid-cols-2 md:grid-cols-3 gap-6">
	<x-lightbox.item 
		preview-image-url="https://cdn.pixabay.com/photo/2015/06/19/21/24/avenue-815297_960_720.jpg"
		image-url="https://cdn.pixabay.com/photo/2015/06/19/21/24/avenue-815297_960_720.jpg"
		image-caption="Image from Pixabay"
	/>

	<x-lightbox.item 
		preview-image-url="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072821_960_720.jpg"
		image-url="https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072821_960_720.jpg"
		image-caption="Image from Pixabay"
	/>

	<x-lightbox.item 
		preview-image-url="https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832_960_720.jpg"
		image-url="https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832_960_720.jpg"
		image-caption="Image from Pixabay"
	/>
</x-lightbox>
```

### Table

```html
 <x-card no-padding>
	<x-table.table class="relative">
		<thead>
			<tr>
				<x-table.thead>Name</x-table.thead>
				<x-table.thead>Email</x-table.thead>
				<x-table.thead>Role</x-table.thead>
				<x-table.thead>Created at</x-table.thead>
			</tr>
		</thead>
		<tbody>
			<tr>
				<x-table.tdata class="md:w-2/5">John Doe</x-table.tdata>
				<x-table.tdata>test@test.test</x-table.tdata>
				<x-table.tdata>Admin</x-table.tdata>
				<x-table.tdata>12 Jan, 2022</x-table.tdata>
			</tr>
		</tbody>
	</x-table.table>
</x-card>
```

### Table Simple Datatable (AlpineJS)

```html
<x-table-simple
	:columns='[
		[
			"name" => "Role",
			"field" => "role"
		],
		[
			"name" => "Created at",
			"field" => "created_at"
		],
		[
			"name" => "Last Online",
			"field" => "last_online_at"
		]
	]'
	:rows="collect($users)->all()['data'] ?? []"
	table-text-link-label="Name">

	<x-slot name="tableTextLink">
		<div class="flex space-x-3 items-center">
			<div class="w-10">
				<img :src="`https://avatars.dicebear.com/api/initials/${row.name}.svg`" alt="avatar" class="rounded object-fit" loading="lazy">
			</div>
			<div>
				<a :href="`users/${row.id}/edit`" class="text-indigo-600 underline block" x-text="row.name"></a>
				<div x-text="row.email" class="text-sm"></div>
			</div>
		</div>
	</x-slot>

</x-table-simple>
```

### Modal

```html
<x-dialog-modal wire:model.defer="show" form-action="savePermissionName">
	<x-slot name="title">Create new permission</x-slot>
	
	<x-slot name="content">
		<x-input
			label="Permission Name"
			name="permissionName"
			wire:model.defer="permissionName"
			hint="Add comma separated permission names  eg. view_users, edit_users, delete_users"
		/>  
	</x-slot>

	<x-slot name="footer">
		<x-button type="submit" color="black" wire:target="savePermissionName" with-spinner>Save</x-button>
	</x-slot>
</x-dialog-modal>
```

### Card Form

```html
 <x-card-form form-action="updateProfile">
	<x-slot name="title">Profile Information</x-slot>
	<x-slot name="description">Update your account's profile information and email address.</x-slot>

	// Form content goes here...
	 
	<x-slot name="footer">
		<div class="mr-4">
			<x-inline-toastr on="saved">Saved.</x-inline-toastr>
		</div>

		<x-button
			color="black"
			with-spinner
			wire:target="updateProfile"
		>Save</x-button>
	</x-slot>
</x-card-form>
```

### Footer with toast message and button

```html
<x-slot name="footer">
	<div class="mr-4">
		<x-inline-toastr on="saved">Saved.</x-inline-toastr>
	</div>

	<x-button
		color="black"
		with-spinner
		wire:target="save"
	>Save</x-button>
</x-slot>
```

### Empty Card

```html
<x-empty />
```

### Radio Groups

```html
<div class="mb-5">
	<x-label for="to" class="mb-1">Send To</x-label>
	<div class="rounded-lg border border-gray-300 divide-y shadow-sm">
		<div :class="{'ring-1 bg-indigo-50 ring-indigo-300 rounded-t-lg relative': toUser === 'all' }" class="py-2 px-4">
			<x-radio 
				id="all" 
				name="to" 
				value="all"
				wire:model="to"
				class="mt-1"
				align="top"
			>
				<div class="text-gray-800 font-medium">All users</div>
				<div class="text-sm text-gray-500">Send notification to all users</div>
			</x-radio>
		</div>
		<div :class="{'ring-1 bg-indigo-50 ring-indigo-300 relative': toUser === 'suppliers' }" class="py-2 px-4">
			<x-radio
				id="suppliers" 
				name="to" 
				value="suppliers"
				wire:model="to"
				class="mt-1"
				align="top"
			>
				<div class="text-gray-800 font-medium">Suppliers</div>
				<div class="text-sm text-gray-500">Send notification to all users having role supplier</div>
			</x-radio>
		</div>
		<div :class="{'ring-1 bg-indigo-50 ring-indigo-300 relative': toUser === 'offices' }" class="py-2 px-4">
			<x-radio
				id="offices" 
				name="to" 
				value="offices"
				wire:model="to"
				class="mt-1"
				align="top"
			>
				<div class="text-gray-800 font-medium">Offices</div>
				<div class="text-sm text-gray-500">Send notification to all users having role office</div>
			</x-radio>
		</div>
		<div :class="{'ring-1 bg-indigo-50 ring-indigo-300 rounded-b-lg relative': toUser === 'selected' }" class="py-2 px-4">
			<x-radio
				id="selected" 
				name="to" 
				value="selected"
				wire:model="to"
				class="mt-1"
				align="top"
			>
				<div class="text-gray-800 font-medium">Selected user</div>
				<div class="text-sm text-gray-500">Send notification to selected user</div>
			</x-radio>
		</div>
	</div>
</div>
```

```html
<x-radio-group 
	label="Select role"
	name="role"
	wire:model="role"
	default-value="moderator"
/>
```

### Radio Pills

```html
<x-radio-pill 
	label="Select size"
	name="size"
	wire:model="size"
	class="md:grid-cols-7"
	default-value="male"
	:options="[
		[
			'label' => 'Male',
			'value' => 'male'
		],
		[
			'label' => 'Female',
			'value' => 'female'
		]
	]"
/>
```

### Dispatch Toast Message From AlpineJS

```html
<x-button type="button" color="white" x-data="{}" x-on:click="$dispatch('notify', {
	'text': 'Hello ths is dispatch',
	'type': 'success'
})">Test notify</x-button>
```

### Card with Icon

```html
<x-card-icon>
	<x-slot name="icon">
		<x-icon-folder class="w-10 h-10" />
	</x-slot>

	<x-heading size="lg" class="mb-2">Allocations</x-heading>

	Lists of allocations given to a supplier for an office in the system.

	<x-slot name="footer" class="text-indigo-600 -mx-5">
		<x-link href="{{ route('allocations') }}" class="flex items-center justify-between px-5">
			<span>See details</span>
			<x-icon-arrow-right-2 class="w-5 h-5" />
		</x-link>
	</x-slot>
</x-card-icon>
```

### Card Link with Icon

```html
<x-card-icon tag="a" href="#">
	<x-slot name="icon">
		<x-icon-folder class="w-10 h-10" />
	</x-slot>

	<x-heading size="lg" class="mb-2">Allocations</x-heading>

	Lists of allocations given to a supplier for an office in the system.
</x-card-icon>
```

### Tom-select

```html
<x-tom-select
	label="Select user"
	id="testUser"
	name="testUser"
	wire:model="testUser"
	:selected-items="[$testUser]"
	:options="[
		[
			'id' => 1,
			'title' => 'John Doe',
			'subtitle' => 'hello@test.test'
		],
		[
			'id' => 2,
			'title' => 'Winter Doe',
			'subtitle' => 'winter@test.test'
		],
		[
			'id' => 3,
			'title' => 'Summer Doe',
			'subtitle' => 'summer@test.test'
		]
	]"
	placeholder="Pick a user"
/>
```

### Virtual Select

```html
<x-virtual-select
	label="Select district office"
	name="districtOffice"
	wire:model="districtOffice"
	:options="[
		'options' => $this->districtOffices,
		'selectedValue' => $districtOffice,
	]"
/>

<x-virtual-select
	label="Select field office"
	name="fieldOffice"
	wire:model.defer="fieldOffice"
	:options="[
		'showValueAsTags' => true,
		'options' => $fieldOffices,
		'multiple' => true,
		'selectedValue' => $fieldOffice,
	]"
	optional
/>
```