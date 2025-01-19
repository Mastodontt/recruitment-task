<div class="form-group">
    <label for="name">Name</label>
    <input 
        type="text" 
        name="name" 
        id="name" 
        class="form-control @error('name') is-invalid @enderror" 
        value="{{ old('name', $pet->name ?? '') }}" 
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="category_id">Category ID</label>
    <input 
        type="number" 
        name="category[id]" 
        id="category_id" 
        class="form-control @error('category.id') is-invalid @enderror" 
        value="{{ old('category.id', $pet->category['id'] ?? '') }}" 
    >
    @error('category.id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="category_name">Category Name</label>
    <input 
        type="text" 
        name="category[name]" 
        id="category_name" 
        class="form-control @error('category.name') is-invalid @enderror" 
        value="{{ old('category.name', $pet->category['name'] ?? '') }}" 
    >
    @error('category.name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="photoUrls">Photo URLs</label>
    <div id="photo-url-container">
        @if (old('photoUrls', $pet->photoUrls ?? []))
            @foreach (old('photoUrls', $pet->photoUrls ?? []) as $photoUrl)
                <input 
                    type="url" 
                    name="photoUrls[]" 
                    class="form-control mt-2 @error('photoUrls.*') is-invalid @enderror" 
                    value="{{ $photoUrl }}" 
                    placeholder="Enter photo URL" 
                >
            @endforeach
        @else
            <input 
                type="url" 
                name="photoUrls[]" 
                class="form-control @error('photoUrls.*') is-invalid @enderror" 
                placeholder="Enter photo URL" 
            >
        @endif
    </div>
    <button type="button" id="add-photo-url" class="btn btn-secondary mt-2">Add More URLs</button>
    @error('photoUrls.*')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Tags (Optional)</label>
    <div id="tags-container">
        @if (old('tags', $pet->tags ?? []))
            @foreach (old('tags', $pet->tags ?? []) as $index => $tag)
                <div class="tag-row mt-2">
                    <input 
                        type="number" 
                        name="tags[{{ $index }}][id]" 
                        placeholder="Tag ID" 
                        class="form-control mb-1 @error("tags.$index.id") is-invalid @enderror" 
                        value="{{ $tag['id'] ?? '' }}"
                    >
                    <input 
                        type="text" 
                        name="tags[{{ $index }}][name]" 
                        placeholder="Tag Name" 
                        class="form-control mb-1 @error("tags.$index.name") is-invalid @enderror" 
                        value="{{ $tag['name'] ?? '' }}"
                    >
                    @error("tags.$index.id")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error("tags.$index.name")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @else
            <div class="tag-row mt-2">
                <input 
                    type="number" 
                    name="tags[0][id]" 
                    placeholder="Tag ID" 
                    class="form-control mb-1"
                >
                <input 
                    type="text" 
                    name="tags[0][name]" 
                    placeholder="Tag Name" 
                    class="form-control mb-1"
                >
            </div>
        @endif
    </div>
    <button type="button" id="add-tag" class="btn btn-secondary mt-2">Add Tag</button>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select 
        name="status" 
        id="status" 
        class="form-control @error('status') is-invalid @enderror" 
    >
        <option value="">Select</option>
        @foreach (\App\Enums\PetStatus::cases() as $status)
            <option 
                value="{{ $status->value }}" 
                {{ old('status', $pet->status ?? '') === $status->value ? 'selected' : '' }}
            >
                {{ $status->name }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<script>
document.getElementById('add-photo-url').addEventListener('click', function () {
    const container = document.getElementById('photo-url-container');
    const input = document.createElement('input');
    input.type = 'url';
    input.name = 'photoUrls[]';
    input.className = 'form-control mt-2';
    input.placeholder = 'Enter photo URL';
    container.appendChild(input);
});

document.getElementById('add-tag').addEventListener('click', function () {
    const container = document.getElementById('tags-container');
    const tagCount = container.querySelectorAll('.tag-row').length;
    const div = document.createElement('div');
    div.className = 'tag-row mt-2';
    div.innerHTML = `
        <input type="number" name="tags[${tagCount}][id]" placeholder="Tag ID" class="form-control mb-1">
        <input type="text" name="tags[${tagCount}][name]" placeholder="Tag Name" class="form-control mb-1">
    `;
    container.appendChild(div);
});
</script>
