<div class="education-row border rounded p-3 mb-3">
    <div class="row g-3">
        <div class="col-md-4">
            <label>Qualification</label>
            <input type="text" name="education[{{ $index }}][qualification_name]" value="{{ $edu->qualification_name ?? '' }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Examining Body</label>
            <input type="text" name="education[{{ $index }}][examining_body]" value="{{ $edu->examining_body ?? '' }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label>Institution Name</label>
            <input type="text" name="education[{{ $index }}][institution_name]" value="{{ $edu->institution_name ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>Start Year</label>
            <input type="text" name="education[{{ $index }}][course_start_year]" value="{{ $edu->course_start_year ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>End Year</label>
            <input type="text" name="education[{{ $index }}][course_end_year]" value="{{ $edu->course_end_year ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>Max Marks</label>
            <input type="text" name="education[{{ $index }}][maximum_marks]" value="{{ $edu->maximum_marks ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>Obtained</label>
            <input type="text" name="education[{{ $index }}][obtained_marks]" value="{{ $edu->obtained_marks ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>% Secured</label>
            <input type="text" name="education[{{ $index }}][secured_percentage]" value="{{ $edu->secured_percentage ?? '' }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>CGPA</label>
            <input type="text" name="education[{{ $index }}][cgpa]" value="{{ $edu->cgpa ?? '' }}" class="form-control">
        </div>

        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-danger btn-sm removeEducation mt-2">Remove</button>
        </div>
    </div>
</div>
