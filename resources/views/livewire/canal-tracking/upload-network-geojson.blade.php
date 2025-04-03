<div>
    <x-slot name="title">Upload Pipe Network File</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', [$scheme->id, 'tab' => 'pipe-network']) }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Upload Pipe Network File
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
    <div class="mb-4">
        <x-alert variant="error" :close="false">
          > Open link in your web browser - https://products.groupdocs.app/conversion/kml-to-geojson
          <p>
          > Drag and drop the KML file here
          </p>
          <p>
          > Once the KML file has been uploaded, click on convert now
          </p>
          <p>
          > Click on download now to download the file in GeoJSON format.
          </p>
          <p>
          > Go to downloaded folder and select ‘rename’ from the right-click context menu on the downloaded GeoJSON file and Change the file extension from Geojson to json. For example “sample.geojson” to “sample.json”
          </p>

        </x-alert>
    </div>

        <x-card overflow-hidden form-action="save">

            <x-filepond accept-files="application/json" label="Upload Pipe Network Json document" name="file"
                wire:model.defer="file" />

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,document">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>