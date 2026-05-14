@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-10 right-10 z-50 bg-green-600 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce">
        <i class="fas fa-check-circle text-2xl"></i>
        <span class="font-bold">{{ session('success') }}</span>
        <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">&times;</button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-10 right-10 z-50 bg-red-600 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-shake">
        <i class="fas fa-exclamation-circle text-2xl"></i>
        <span class="font-bold">{{ session('error') }}</span>
        <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">&times;</button>
    </div>
@endif
