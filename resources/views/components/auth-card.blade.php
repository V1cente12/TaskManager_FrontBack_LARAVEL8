<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md">
        <img src="{{ asset('uploads/family.jpg') }}" alt="Logo" class="w-full" style="mask-image: radial-gradient(circle, rgba(0,0,0,1) 70%, rgba(0,0,0,0) 100%);">
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
