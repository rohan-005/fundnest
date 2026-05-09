@extends('layout')

@section('content')

<div class="max-w-2xl">

    <div class="mb-8">
        <a href="{{ route('profile.show') }}" class="text-muted text-sm hover:text-primary">← Back to Profile</a>
        <h1 class="page-title mt-2">Edit Profile</h1>
    </div>

    <div class="card p-8">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- PHOTO --}}
            <div>
                <label class="block text-sm font-semibold mb-3">Profile Photo</label>
                <div class="flex items-center gap-5">
                    <img src="{{ $user->photoUrl() }}" alt="{{ $user->name }}"
                         class="w-16 h-16 rounded-2xl object-cover" id="photo-preview">
                    <div>
                        <input type="file" name="photo" id="photo-input" accept="image/*" class="hidden"
                               onchange="previewPhoto(this)">
                        <label for="photo-input"
                               class="btn-primary cursor-pointer text-sm py-2 px-4 inline-block">
                            Upload Photo
                        </label>
                        <p class="text-xs text-muted mt-1">Max 2MB · JPG, PNG</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-semibold mb-2">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="input" value="{{ old('name', $user->name) }}" required>
                    @error('name')<p class="text-danger text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Phone</label>
                    <input type="tel" name="phone" class="input" value="{{ old('phone', $user->phone) }}"
                           placeholder="+91 98765 43210">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Institution</label>
                    <input type="text" name="institution" class="input"
                           value="{{ old('institution', $user->institution) }}"
                           placeholder="University / College name">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">CGPA</label>
                    <input type="number" name="cgpa" class="input" step="0.01" min="0" max="10"
                           value="{{ old('cgpa', $user->cgpa) }}" placeholder="0.00 – 10.00">
                    @error('cgpa')<p class="text-danger text-xs mt-1">{{ $message }}</p>@enderror
                </div>

            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Bio</label>
                <textarea name="bio" class="input h-24 resize-none"
                          placeholder="A short description about yourself…">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Achievements</label>
                <textarea name="achievements" class="input h-28 resize-none"
                          placeholder="Awards, ranks, competitions, extracurriculars…">{{ old('achievements', $user->achievements) }}</textarea>
            </div>

            <button type="submit" class="btn-primary w-full">Save Changes</button>
        </form>
    </div>

</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('photo-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
