<div
	x-data="{
		notices: [],
		add(notice) {
			notice.id = Date.now()
			this.notices.push(notice)
		},
		remove(id) {
			this.notices = this.notices.filter(notice => notice.id != id)
		}
	}"
	@notify.window="add($event.detail)"
	x-cloak
	class="fixed flex flex-col-reverse items-start max-w-sm w-full left-0 right-0 top-0 mx-auto pointer-events-none pb-10 pt-2 space-y-4" style="z-index: 2000">
	<template x-for="notice in notices" :key="notice.id">
		<div
			x-data="{
				show: false,
				init() {
					this.$nextTick(() => this.show = true);
					setTimeout(() => {
						this.removeNotice()
					}, 4500)
				},
				removeNotice() {
					this.show = false
					setTimeout(() => {
						this.remove(notice.id)
					}, 500)
				}
			}"
			x-show="show"
			x-on:click="removeNotice()"
			x-transition.duration.500ms
			style="box-shadow: 0px 2px 8px 0px rgba(99, 99, 99, 0.35); min-width: 320px;"
			class="cursor-pointer pointer-events-auto rounded-md mx-auto"
			:class="{ 
				'bg-slate-800 text-slate-200': ['info-dark', 'success-dark', 'error-dark'].includes(notice.type),  
				{{-- 'bg-white text-gray-700': ['info', 'success', 'error'].includes(notice.type), --}}
				'bg-green-50 text-green-700': notice.type === 'success',
				'bg-blue-50 text-blue-700': notice.type === 'info',
				'bg-red-50 text-red-700': notice.type === 'error'
			}"
			>
			<div class="overflow-hidden flex relative pl-3 pr-5 py-2 rounded-md h-12">
				<div class="flex-shrink-0 mr-3">
                    <template x-if="['info', 'notice'].includes(notice.type)">
						<svg class="w-8 h-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm-2,48a12,12,0,1,1-12,12A12,12,0,0,1,126,72Zm10,112h-8a8,8,0,0,1-8-8V128a8,8,0,0,1,0-16h8a8,8,0,0,1,8,8v48a8,8,0,0,1,0,16Z"></path></svg>
                    </template>
                    <template x-if="notice.type === 'success'">
						<svg class="w-8 h-8 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z"></path></svg>
                    </template>
                    <template x-if="notice.type === 'error'">
						<svg class="w-8 h-8 fill-current text-red-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm37.7,130.3a8.1,8.1,0,0,1,0,11.4,8.2,8.2,0,0,1-11.4,0L128,139.3l-26.3,26.4a8.2,8.2,0,0,1-11.4,0,8.1,8.1,0,0,1,0-11.4L116.7,128,90.3,101.7a8.1,8.1,0,0,1,11.4-11.4L128,116.7l26.3-26.4a8.1,8.1,0,0,1,11.4,11.4L139.3,128Z"></path></svg>
                    </template>
					<template x-if="notice.type === 'success-dark'">
						<svg class="w-8 h-8 text-green-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM16.78 9.7L11.11 15.37C10.97 15.51 10.78 15.59 10.58 15.59C10.38 15.59 10.19 15.51 10.05 15.37L7.22 12.54C6.93 12.25 6.93 11.77 7.22 11.48C7.51 11.19 7.99 11.19 8.28 11.48L10.58 13.78L15.72 8.64C16.01 8.35 16.49 8.35 16.78 8.64C17.07 8.93 17.07 9.4 16.78 9.7Z" fill="currentColor"/></svg>
                    </template>
					<template x-if="notice.type === 'error-dark'">
						<svg class="w-8 h-8 text-red-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM11.25 8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V13C12.75 13.41 12.41 13.75 12 13.75C11.59 13.75 11.25 13.41 11.25 13V8ZM12.92 16.38C12.87 16.51 12.8 16.61 12.71 16.71C12.61 16.8 12.5 16.87 12.38 16.92C12.26 16.97 12.13 17 12 17C11.87 17 11.74 16.97 11.62 16.92C11.5 16.87 11.39 16.8 11.29 16.71C11.2 16.61 11.13 16.51 11.08 16.38C11.03 16.26 11 16.13 11 16C11 15.87 11.03 15.74 11.08 15.62C11.13 15.5 11.2 15.39 11.29 15.29C11.39 15.2 11.5 15.13 11.62 15.08C11.86 14.98 12.14 14.98 12.38 15.08C12.5 15.13 12.61 15.2 12.71 15.29C12.8 15.39 12.87 15.5 12.92 15.62C12.97 15.74 13 15.87 13 16C13 16.13 12.97 16.26 12.92 16.38Z" fill="currentcolor"/></svg>
                    </template>
					<template x-if="notice.type === 'info-dark'">
						<svg class="w-8 h-8 text-blue-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M20.1892 14.0608L19.0592 12.1808C18.8092 11.7708 18.5892 10.9808 18.5892 10.5008V8.63078C18.5892 5.00078 15.6392 2.05078 12.0192 2.05078C8.38923 2.06078 5.43923 5.00078 5.43923 8.63078V10.4908C5.43923 10.9708 5.21923 11.7608 4.97923 12.1708L3.84923 14.0508C3.41923 14.7808 3.31923 15.6108 3.58923 16.3308C3.85923 17.0608 4.46923 17.6408 5.26923 17.9008C6.34923 18.2608 7.43923 18.5208 8.54923 18.7108C8.65923 18.7308 8.76923 18.7408 8.87923 18.7608C9.01923 18.7808 9.16923 18.8008 9.31923 18.8208C9.57923 18.8608 9.83923 18.8908 10.1092 18.9108C10.7392 18.9708 11.3792 19.0008 12.0192 19.0008C12.6492 19.0008 13.2792 18.9708 13.8992 18.9108C14.1292 18.8908 14.3592 18.8708 14.5792 18.8408C14.7592 18.8208 14.9392 18.8008 15.1192 18.7708C15.2292 18.7608 15.3392 18.7408 15.4492 18.7208C16.5692 18.5408 17.6792 18.2608 18.7592 17.9008C19.5292 17.6408 20.1192 17.0608 20.3992 16.3208C20.6792 15.5708 20.5992 14.7508 20.1892 14.0608ZM12.7492 10.0008C12.7492 10.4208 12.4092 10.7608 11.9892 10.7608C11.5692 10.7608 11.2292 10.4208 11.2292 10.0008V6.90078C11.2292 6.48078 11.5692 6.14078 11.9892 6.14078C12.4092 6.14078 12.7492 6.48078 12.7492 6.90078V10.0008Z" fill="currentColor"/>
							<path d="M14.8297 20.01C14.4097 21.17 13.2997 22 11.9997 22C11.2097 22 10.4297 21.68 9.87969 21.11C9.55969 20.81 9.31969 20.41 9.17969 20C9.30969 20.02 9.43969 20.03 9.57969 20.05C9.80969 20.08 10.0497 20.11 10.2897 20.13C10.8597 20.18 11.4397 20.21 12.0197 20.21C12.5897 20.21 13.1597 20.18 13.7197 20.13C13.9297 20.11 14.1397 20.1 14.3397 20.07C14.4997 20.05 14.6597 20.03 14.8297 20.01Z" fill="currentColor"/>
							</svg>
					</template>
                </div>
				<div class="flex-1 font-semibold leading-tight flex items-center truncate" x-text="notice.text"></div>
			</div>
		</div>
	</template>
</div>