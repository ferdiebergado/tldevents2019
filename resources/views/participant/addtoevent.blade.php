<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="participant_role_id">Role <small class="text-muted">(*Required)</small></label>
            <select class="custom-select @error('participant_role_id') is-invalid @enderror" name="participant_role_id"
                id="participant_role_id" required>
                <option>Select...</option>
                <option value="1">Participant</option>
                <option value="2">Writer</option>
                <option value="3">Resource Speaker</option>
            </select>
            @error('participant_role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="learning_area_id">Learning Area</label>
            <select class="custom-select" name="learning_area_id" id="learning_area_id">
                <option>Select...</option>
                <option value="1">Filipino</option>
                <option value="2">English</option>
                <option value="3">Science</option>
            </select>
            <small class="form-text text-muted">
                (If applicable.)
            </small>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="language_id">Language</label>
            <select class="custom-select" name="language_id" id="language_id">
                <option>Select...</option>
                <option value="1">Ilokano</option>
                <option value="2">Ivatan</option>
                <option value="3">Sambal</option>
            </select>
            <small class="form-text text-muted">
                (If applicable.)
            </small>
        </div>
    </div>
</div>