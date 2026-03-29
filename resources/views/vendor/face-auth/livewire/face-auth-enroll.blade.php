<div>
    <div class="container mx-auto max-w-2xl px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Face Authentication</h1>
        <div class="rounded-lg bg-white dark:bg-gray-800 shadow-sm border p-6 mb-6">
            <h3 class="text-lg font-medium mb-2">Enroll Your Face</h3>
            <p class="text-sm text-gray-500 mb-4">Camera and face detection handled client-side via face-api.js</p>
            <video id="face-video" autoplay muted playsinline class="w-full rounded-lg bg-gray-900 mb-4" style="max-height:400px" wire:ignore></video>
            <div class="flex gap-3">
                <button id="btn-enroll" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">Enroll</button>
                <button id="btn-verify" class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm">Verify</button>
            </div>
        </div>
        <div class="rounded-lg bg-white dark:bg-gray-800 shadow-sm border p-6">
            <h3 class="text-lg font-medium mb-4">Enrolled Faces</h3>
            @forelse($enrollments as $e)
                <div class="flex items-center justify-between py-2 border-b last:border-0">
                    <span class="text-sm">{{ $e['label'] ?? 'Face' }} @if($e['is_primary'] ?? false)<span class="text-xs text-blue-600">(Primary)</span>@endif</span>
                    <button wire:click="removeEnrollment({{ $e['id'] }})" class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Remove</button>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No faces enrolled yet.</p>
            @endforelse
        </div>
    </div>
</div>
