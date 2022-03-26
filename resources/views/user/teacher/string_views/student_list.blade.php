@if ($students->isNotEmpty())
    <div class="row">
        <div class="col-md-12">
            <input type="checkbox" name="select_all" id="select_all">
            <label for="select_all">Select all</label>
        </div>
    </div>
@endif

<div class="row">
    @forelse ($students as $item)
        <div class="col-md-3">
            <div>
                <div class="alert alert-primary" role="alert">
                    <input class="assign_student _checked_students" type="checkbox" name="students[]" value="{{ $item->id }}" id="student_{{ $item->id }}">
                    <label for="student_{{ $item->id }}">{{ $item->name }} ( {{ $item->enrollment_number }} )</label>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12">
            <h4>No students available</h4>
        </div>
    @endforelse
</div>

@if ($students->isNotEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <span id="select_student_err" class="text-danger m-2" style="display: none;">Please select students to assign</span>
                <button id="assign_worksheet_done" class="btn btn-success">Assign</button>
            </div>
        </div>
    </div>
@endif