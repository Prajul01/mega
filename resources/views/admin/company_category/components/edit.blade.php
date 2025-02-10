<form method="POST" action="{{ route('admin.company_category.update', base64_encode($company_category->id)) }}"
    enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ old('title', $company_category->title) }}" aria-label="Title"
                        aria-describedby="basic-addon1" required>
                </div>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Industry</span>
                    </div>
                    <select name="industry_id" class="form-control" id="">
                        <option value="" selected disabled> --Select Industry-- </option>
                        @foreach (App\Models\Industry::where('status', 'active')->select('id', 'name')->get() as $industry)
                            <option value="{{ $industry->id }}"
                                {{ old('industry_id', $company_category->industry_id) == $industry->id ? 'selected' : '' }}>
                                {{ $industry->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('industry_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($company_category->status == 'active') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.company_category.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
